# 🏊 Natación Club 프로젝트 작업 플랜

## 📋 프로젝트 개요

- **목적**: 수영 클럽 관리 시스템 구축
- **기술 스택**: PHP + PDO, MySQL/MariaDB, HTML, Tailwind CSS
- **핵심 요구사항**: PDO, Prepared Statements, Transaction 처리

---

## 🎯 Phase 1: 프로젝트 구조 및 데이터베이스 설정

### 1.1 디렉토리 구조 생성

```
natacion_club/
├── config/
│   └── database.php
├── includes/
│   ├── auth.php
│   └── functions.php
├── public/
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   ├── nadadores/
│   ├── pagos/
│   ├── competiciones/
│   └── reportes/
├── assets/css/
└── sql/
```

### 1.2 데이터베이스 스키마 생성 (sql/schema.sql)

- 9개 테이블 생성 스크립트
- 외래키 제약조건 설정
- 인덱스 최적화

### 1.3 초기 데이터 삽입 (sql/seed.sql)

- categorias: 7개 카테고리 (Pre-Benjamín ~ Máster)
- pruebas: 10개 종목 (50m/100m/200m/400m 자유형, 배영, 평영, 접영, 혼계영)
- usuarios: 테스트용 코치/가족/선수 계정
- tiempos_minimos: 샘플 최소 기록 데이터

### 1.4 PDO 데이터베이스 연결 설정

- UTF-8 인코딩 설정
- 에러 모드 설정 (PDO::ERRMODE_EXCEPTION)
- 싱글톤 패턴 적용

---

## 🔐 Phase 2: 핵심 인증 시스템 구축

### 2.1 로그인/로그아웃 시스템

- **login.php**: 이메일 + 비밀번호 검증

  - password_verify() 사용
  - 세션 생성 및 역할 저장
  - CSRF 토큰 생성

- **logout.php**: 세션 파괴
  - session_destroy()
  - 쿠키 삭제

### 2.2 역할별 권한 관리 (includes/auth.php)

```php
function checkRole($allowedRoles) {
    // 세션 검증
    // 역할 확인
    // 권한 없으면 리다이렉트
}
```

### 2.3 비밀번호 해싱 시스템

- 회원가입: password_hash(PASSWORD_BCRYPT)
- 로그인: password_verify()

---

## 👤 Phase 3: 선수 관리 (CRUD) 기능 구현

### 3.1 선수 등록 (nadadores/create.php)

**핵심 기능:**

1. 입력 폼

   - nombre, apellidos, fecha_nacimiento
   - email, telefono
   - 계정 연결 (id_usuario) - 선택사항

2. **카테고리 자동 계산 로직**

```php
// 생년월일 → 나이 계산 (2026년 기준)
$edad = date('Y') - date('Y', strtotime($fecha_nacimiento));

// 카테고리 조회
$stmt = $pdo->prepare("
    SELECT id_categoria
    FROM categorias
    WHERE :edad BETWEEN edad_minima AND edad_maxima
");
```

3. Prepared Statement로 INSERT

### 3.2 선수 목록 조회 (nadadores/index.php)

- JOIN으로 카테고리명 포함
- 페이지네이션 적용
- 검색 기능 (이름, 성)
- 필터 (카테고리별, 납부 상태별)

### 3.3 선수 수정 (nadadores/edit.php)

- 기존 데이터 로드
- UPDATE with Prepared Statements
- 생년월일 변경 시 카테고리 재계산

### 3.4 선수 삭제 (nadadores/delete.php)

- 외래키 제약 확인
- CASCADE 처리 또는 경고 메시지
- 소프트 삭제 고려

---

## 💰 Phase 4: 납부 관리 시스템 구현 (트랜잭션 포함)

### 4.1 납부 등록 (pagos/create.php)

**핵심: 트랜잭션 처리**

```php
$pdo->beginTransaction();
try {
    // 1. pagos 테이블에 INSERT
    $stmt = $pdo->prepare("
        INSERT INTO pagos (id_nadador, fecha_pago, cantidad, mes_pagado)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([$id_nadador, $fecha_pago, $cantidad, $mes_pagado]);

    // 2. nadadores 테이블의 ultimo_mes_pagado 업데이트
    $stmt = $pdo->prepare("
        UPDATE nadadores
        SET ultimo_mes_pagado = ?
        WHERE id_nadador = ?
    ");
    $stmt->execute([$mes_pagado, $id_nadador]);

    $pdo->commit();
    echo "납부가 성공적으로 등록되었습니다.";
} catch (Exception $e) {
    $pdo->rollBack();
    echo "오류: " . $e->getMessage();
}
```

### 4.2 납부 내역 조회 (pagos/index.php)

- 선수별 납부 내역
- 월별 필터링
- 총 납부 금액 계산

### 4.3 미납자 목록

```sql
SELECT n.*,
       COALESCE(n.ultimo_mes_pagado, 'NUNCA') as ultimo_pago,
       TIMESTAMPDIFF(MONTH,
           STR_TO_DATE(CONCAT(n.ultimo_mes_pagado, '-01'), '%Y-%m-%d'),
           CURDATE()) as meses_sin_pagar
FROM nadadores n
WHERE n.ultimo_mes_pagado IS NULL
   OR n.ultimo_mes_pagado < DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 1 MONTH), '%Y-%m')
```

---

## 🏆 Phase 5: 대회 및 기록 관리 기능 구현

### 5.1 대회 관리 (competiciones/)

- **등록**: create.php (nombre, fecha, lugar)
- **목록**: index.php with JOIN
- **수정/삭제**: edit.php, delete.php

### 5.2 대회별 선수 수 필터링 (competiciones/filter.php)

```sql
SELECT
    c.id_competicion,
    c.nombre,
    c.fecha,
    c.lugar,
    COUNT(DISTINCT r.id_nadador) as total_nadadores
FROM competiciones c
LEFT JOIN resultados r ON c.id_competicion = r.id_competicion
GROUP BY c.id_competicion
HAVING total_nadadores >= :min_nadadores
ORDER BY c.fecha DESC
```

### 5.3 대회 결과 등록 (resultados/create.php)

- 선수 선택 (드롭다운)
- 대회 선택
- 종목 선택
- 기록 입력 (MM:SS.ms → 초 변환)
- UNIQUE 제약 체크 (선수+대회+종목)

---

## 📊 Phase 6: 고급 리포트 및 분석 기능 구현

### 6.1 기록 비교 리포트 (reportes/tiempos.php)

**4개 테이블 JOIN 쿼리**

```sql
SELECT
    n.id_nadador,
    CONCAT(n.nombre, ' ', n.apellidos) AS nombre_completo,
    cat.nombre AS categoria,
    p.nombre AS prueba,
    comp.nombre AS competicion,
    comp.fecha,
    r.tiempo AS tiempo_real,
    tm.tiempo_minimo,
    (r.tiempo - tm.tiempo_minimo) AS diferencia,
    CASE
        WHEN r.tiempo <= tm.tiempo_minimo THEN 'CUMPLE'
        ELSE 'NO CUMPLE'
    END AS estado
FROM resultados r
INNER JOIN nadadores n ON r.id_nadador = n.id_nadador
INNER JOIN categorias cat ON n.id_categoria = cat.id_categoria
INNER JOIN pruebas p ON r.id_prueba = p.id_prueba
INNER JOIN competiciones comp ON r.id_competicion = comp.id_competicion
LEFT JOIN tiempos_minimos tm ON tm.id_prueba = r.id_prueba
    AND tm.id_categoria = n.id_categoria
WHERE (:id_nadador IS NULL OR n.id_nadador = :id_nadador)
  AND (:id_categoria IS NULL OR n.id_categoria = :id_categoria)
ORDER BY n.apellidos, n.nombre, comp.fecha DESC
```

### 6.2 선수별 진척도 리포트

- 시간 경과에 따른 기록 향상 그래프
- 종목별 베스트 타임
- 카테고리 내 순위

### 6.3 코치 대시보드

- 전체 선수 수
- 월별 납부율
- 최근 대회 결과 요약
- 최소 기록 미달 선수 목록

---

## 🎨 Phase 7: UI/UX 개선 및 보안 강화

### 7.1 Tailwind CSS 적용

- 반응형 디자인
- 테이블 스타일링
- 폼 검증 메시지
- 모달/알림창

### 7.2 보안 강화

- [ ] CSRF 토큰 모든 폼에 적용
- [ ] XSS 방지 (htmlspecialchars)
- [ ] SQL Injection 방지 (모든 쿼리에 Prepared Statements)
- [ ] 세션 하이재킹 방지
  ```php
  session_regenerate_id(true);
  ```
- [ ] 입력 검증 (클라이언트 + 서버)

### 7.3 에러 핸들링

- try-catch 블록
- 사용자 친화적 에러 메시지
- 로그 파일 기록

---

## 🧪 Phase 8: 테스팅 및 최종 검토

### 8.1 기능 테스트

- [ ] 로그인/로그아웃 테스트 (3가지 역할)
- [ ] 선수 CRUD 전체 프로세스
- [ ] 납부 트랜잭션 롤백 테스트
- [ ] 대회 필터링 정확성
- [ ] 리포트 쿼리 성능 측정

### 8.2 보안 체크리스트

- [ ] 모든 Prepared Statements 확인
- [ ] password_hash/verify 동작 확인
- [ ] 역할별 페이지 접근 제어 검증
- [ ] CSRF 토큰 검증

### 8.3 성능 최적화

- [ ] 인덱스 추가 (자주 검색되는 컬럼)
- [ ] 쿼리 최적화 (EXPLAIN 분석)
- [ ] 불필요한 JOIN 제거

---

## 📌 우선순위 및 주의사항

### 반드시 지켜야 할 사항

1. **PDO + Prepared Statements**: 모든 DB 작업
2. **트랜잭션**: pagos 테이블 INSERT 시 필수
3. **카테고리 자동 계산**: 생년월일 기반
4. **시간 형식**: DECIMAL(8,2) 초 단위 저장
5. **OOP 스타일** OOP 스타일을 준수한다

### 권장 개발 순서

1. Phase 1-2 (인프라 + 인증) - **필수 선행**
2. Phase 3 (선수 관리) - **핵심 기능**
3. Phase 4 (납부 관리) - **트랜잭션 실습**
4. Phase 5-6 (대회/리포트) - **JOIN 쿼리 실습**
5. Phase 7-8 (UI/보안/테스트) - **마무리**

---

## 📅 작업 진행 상황

### 완료된 Phase

- [ ] Phase 1: 프로젝트 구조 및 데이터베이스 설정
- [ ] Phase 2: 핵심 인증 시스템 구축
- [ ] Phase 3: 선수 관리 (CRUD) 기능 구현
- [ ] Phase 4: 납부 관리 시스템 구현
- [ ] Phase 5: 대회 및 기록 관리 기능 구현
- [ ] Phase 6: 고급 리포트 및 분석 기능 구현
- [ ] Phase 7: UI/UX 개선 및 보안 강화
- [ ] Phase 8: 테스팅 및 최종 검토

---

_작업 플랜 생성일: 2026-01-11_
_기반 문서: natacion_club_project.md_
