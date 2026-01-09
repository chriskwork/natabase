# 🏊 Natación Club - 수영클럽 관리 시스템

## 프로젝트 개요

| 항목 | 내용 |
|------|------|
| 프로젝트명 | Gestión de Equipo de Natación (수영팀 관리) |
| DB명 | `natacion_club` |
| 백엔드 | PHP + PDO |
| 데이터베이스 | MySQL / MariaDB |
| 프론트엔드 | HTML + CSS (Tailwind CSS) |

### 핵심 기술 요구사항
- **PDO**: 모든 DB 연결에 사용
- **Prepared Statements**: INSERT, UPDATE, DELETE 시 필수
- **Transaction**: 납부 처리 시 BEGIN/COMMIT/ROLLBACK 필수

---

## 사용자 역할 (Roles)

| 역할 | 설명 | 주요 권한 |
|------|------|----------|
| **Entrenador (코치)** | 팀 관리자 | 전체 관리, 기록 분석, 리포트 조회 |
| **Familia (가족)** | 선수 보호자 | 납부 관리, 자녀 정보 조회 |
| **Nadador (선수)** | 수영 선수 | 본인 기록 조회, 대회 정보 확인 |

---

## 데이터베이스 테이블 설계

### 1. usuarios (사용자)
| 컬럼 | 타입 | 제약조건 | 설명 |
|------|------|----------|------|
| id_usuario | INT | PK, AUTO_INCREMENT | 사용자 ID |
| email | VARCHAR(150) | UNIQUE, NOT NULL | 이메일 (로그인 ID) |
| password | VARCHAR(255) | NOT NULL | 비밀번호 (해시) |
| rol | ENUM('entrenador', 'familia', 'nadador') | NOT NULL | 역할 |
| nombre | VARCHAR(100) | NOT NULL | 이름 |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | 가입일 |

### 2. categorias (카테고리)
| 컬럼 | 타입 | 제약조건 | 설명 |
|------|------|----------|------|
| id_categoria | INT | PK, AUTO_INCREMENT | 카테고리 ID |
| nombre | VARCHAR(50) | NOT NULL | 카테고리명 |
| edad_minima | INT | NOT NULL | 최소 나이 |
| edad_maxima | INT | NOT NULL | 최대 나이 |

**초기 데이터 (2026년 기준)**
| nombre | edad_minima | edad_maxima |
|--------|-------------|-------------|
| Pre-Benjamín | 0 | 8 |
| Benjamín | 9 | 10 |
| Alevín | 11 | 12 |
| Infantil | 13 | 14 |
| Junior | 15 | 18 |
| Absoluto | 19 | 24 |
| Máster | 25 | 99 |

### 3. nadadores (선수)
| 컬럼 | 타입 | 제약조건 | 설명 |
|------|------|----------|------|
| id_nadador | INT | PK, AUTO_INCREMENT | 선수 ID |
| id_usuario | INT | FK → usuarios, UNIQUE | 연결된 사용자 계정 |
| nombre | VARCHAR(100) | NOT NULL | 이름 |
| apellidos | VARCHAR(100) | NOT NULL | 성 |
| fecha_nacimiento | DATE | NOT NULL | 생년월일 |
| id_categoria | INT | FK → categorias | 카테고리 (자동 계산) |
| email | VARCHAR(150) | | 이메일 |
| telefono | VARCHAR(20) | | 전화번호 |
| ultimo_mes_pagado | VARCHAR(7) | | 마지막 납부월 (YYYY-MM) |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | 등록일 |

### 4. familia_nadador (가족-선수 관계)
| 컬럼 | 타입 | 제약조건 | 설명 |
|------|------|----------|------|
| id | INT | PK, AUTO_INCREMENT | ID |
| id_usuario | INT | FK → usuarios | 가족 사용자 ID |
| id_nadador | INT | FK → nadadores | 선수 ID |

> 한 가족이 여러 선수를 관리할 수 있음 (1:N)

### 5. pruebas (종목)
| 컬럼 | 타입 | 제약조건 | 설명 |
|------|------|----------|------|
| id_prueba | INT | PK, AUTO_INCREMENT | 종목 ID |
| nombre | VARCHAR(100) | NOT NULL | 종목명 |

**초기 데이터 예시**
- 50m Libre, 100m Libre, 200m Libre
- 50m Espalda, 100m Espalda
- 50m Braza, 100m Braza
- 50m Mariposa, 100m Mariposa
- 200m Estilos, 400m Estilos

### 6. competiciones (대회)
| 컬럼 | 타입 | 제약조건 | 설명 |
|------|------|----------|------|
| id_competicion | INT | PK, AUTO_INCREMENT | 대회 ID |
| nombre | VARCHAR(200) | NOT NULL | 대회명 |
| fecha | DATE | NOT NULL | 대회 날짜 |
| lugar | VARCHAR(200) | NOT NULL | 장소 |

### 7. pagos (납부)
| 컬럼 | 타입 | 제약조건 | 설명 |
|------|------|----------|------|
| id_pago | INT | PK, AUTO_INCREMENT | 납부 ID |
| id_nadador | INT | FK → nadadores | 선수 ID |
| fecha_pago | DATE | NOT NULL | 납부일 |
| cantidad | DECIMAL(10,2) | NOT NULL | 금액 |
| mes_pagado | VARCHAR(7) | NOT NULL | 납부 대상월 (YYYY-MM) |

### 8. tiempos_minimos (최소 기록 - 연맹 기준)
| 컬럼 | 타입 | 제약조건 | 설명 |
|------|------|----------|------|
| id_tiempo_minimo | INT | PK, AUTO_INCREMENT | ID |
| id_categoria | INT | FK → categorias | 카테고리 |
| id_prueba | INT | FK → pruebas | 종목 |
| tiempo_minimo | DECIMAL(8,2) | NOT NULL | 최소 기록 (초) |

> UNIQUE(id_categoria, id_prueba) - 카테고리+종목 조합 유일

### 9. resultados (대회 기록)
| 컬럼 | 타입 | 제약조건 | 설명 |
|------|------|----------|------|
| id_resultado | INT | PK, AUTO_INCREMENT | ID |
| id_nadador | INT | FK → nadadores | 선수 |
| id_competicion | INT | FK → competiciones | 대회 |
| id_prueba | INT | FK → pruebas | 종목 |
| tiempo | DECIMAL(8,2) | NOT NULL | 기록 (초) |

> UNIQUE(id_nadador, id_competicion, id_prueba) - 선수+대회+종목 조합 유일

---

## ERD (Entity Relationship Diagram)

```
┌──────────────┐
│   usuarios   │
│──────────────│
│ id_usuario   │◄─────────────────────────────────┐
│ email        │                                  │
│ password     │                                  │
│ rol          │                                  │
│ nombre       │                                  │
└──────────────┘                                  │
       │                                          │
       │ 1:1 (nadador)                            │ 1:N (familia)
       ▼                                          │
┌──────────────┐      ┌──────────────┐            │
│  nadadores   │      │  categorias  │            │
│──────────────│      │──────────────│            │
│ id_nadador   │◄──┐  │ id_categoria │◄──┐        │
│ id_usuario   │   │  │ nombre       │   │        │
│ nombre       │   │  │ edad_minima  │   │        │
│ apellidos    │   │  │ edad_maxima  │   │        │
│fecha_nacim.. │   │  └──────────────┘   │        │
│ id_categoria─│───┘         │           │        │
│ email        │             │           │        │
│ telefono     │             │           │        │
│ultimo_mes_.. │             │           │        │
└──────────────┘             │           │        │
       │                     │           │        │
       │                     ▼           │        │
       │              ┌──────────────────┴───┐    │
       │              │   tiempos_minimos    │    │
       │              │──────────────────────│    │
       │              │ id_tiempo_minimo     │    │
       │              │ id_categoria         │    │
       │              │ id_prueba ───────────│────│────┐
       │              │ tiempo_minimo        │    │    │
       │              └──────────────────────┘    │    │
       │                                          │    │
       ├──────────────────────┐                   │    │
       │                      │                   │    │
       ▼                      ▼                   │    ▼
┌──────────────┐      ┌───────────────────┐      │  ┌──────────────┐
│    pagos     │      │ familia_nadador   │      │  │   pruebas    │
│──────────────│      │───────────────────│      │  │──────────────│
│ id_pago      │      │ id                │      │  │ id_prueba    │◄─┐
│ id_nadador   │      │ id_usuario────────│──────┘  │ nombre       │  │
│ fecha_pago   │      │ id_nadador        │         └──────────────┘  │
│ cantidad     │      └───────────────────┘                │          │
│ mes_pagado   │                                           │          │
└──────────────┘                                           │          │
       ▲                                                   │          │
       │                                                   │          │
       │                    ┌──────────────────────────────┘          │
       │                    │                                         │
       │                    ▼                                         │
       │         ┌──────────────────┐      ┌──────────────┐           │
       │         │   resultados     │      │ competiciones│           │
       │         │──────────────────│      │──────────────│           │
       │         │ id_resultado     │      │id_competicion│◄──┐       │
       │         │ id_nadador ──────│──┐   │ nombre       │   │       │
       │         │ id_competicion ──│──│───│ fecha        │   │       │
       │         │ id_prueba ───────│──│───│ lugar        │   │       │
       │         │ tiempo           │  │   └──────────────┘   │       │
       │         └──────────────────┘  │                      │       │
       │                    │          │                      │       │
       │                    │          └──────────────────────┘       │
       │                    │                                         │
       │                    └─────────────────────────────────────────┘
       │
  nadadores.id_nadador
```

### 관계 요약

| 관계 | 타입 | 설명 |
|------|------|------|
| usuarios → nadadores | 1:1 | 선수 계정 연결 |
| usuarios → familia_nadador | 1:N | 가족이 여러 선수 관리 |
| categorias → nadadores | 1:N | 카테고리별 선수들 |
| categorias → tiempos_minimos | 1:N | 카테고리별 최소 기록 |
| pruebas → tiempos_minimos | 1:N | 종목별 최소 기록 |
| pruebas → resultados | 1:N | 종목별 대회 기록 |
| nadadores → pagos | 1:N | 선수별 납부 내역 |
| nadadores → resultados | 1:N | 선수별 대회 기록 |
| competiciones → resultados | 1:N | 대회별 기록 |

---

## 기능 요구사항

### 🔐 인증/권한
- [ ] 로그인/로그아웃
- [ ] 역할별 접근 제어 (코치/가족/선수)
- [ ] 비밀번호 해시 처리 (password_hash)

### 👤 선수 관리 (CRUD)
- [ ] 선수 등록 폼
- [ ] **카테고리 자동 계산**: 생년월일 → 나이 계산 → 카테고리 배정
- [ ] 선수 목록 조회
- [ ] 선수 정보 수정
- [ ] 선수 삭제

### 💰 납부 관리 (CRUD + Transaction)
- [ ] 납부 등록 폼
- [ ] **트랜잭션 처리**:
  ```
  BEGIN TRANSACTION
  → INSERT INTO pagos
  → UPDATE nadadores SET ultimo_mes_pagado
  → COMMIT / ROLLBACK
  ```
- [ ] 납부 내역 조회
- [ ] 납부 상태 확인 (미납자 목록)

### 🏆 대회 관리 (JOIN 쿼리)
- [ ] 대회 등록/수정/삭제
- [ ] 대회 목록 (날짜, 장소)
- [ ] **필터**: 등록 선수 수로 대회 필터링
  ```sql
  SELECT c.*, COUNT(r.id_nadador) as total_nadadores
  FROM competiciones c
  LEFT JOIN resultados r ON c.id_competicion = r.id_competicion
  GROUP BY c.id_competicion
  HAVING total_nadadores >= ?
  ```

### ⏱️ 기록 관리 (Multiple JOIN)
- [ ] 대회 결과 등록
- [ ] **코치용 리포트**: 선수 기록 vs 최소 기록 비교
  ```sql
  SELECT 
    n.nombre, n.apellidos,
    p.nombre AS prueba,
    r.tiempo AS tiempo_real,
    tm.tiempo_minimo
  FROM resultados r
  JOIN nadadores n ON r.id_nadador = n.id_nadador
  JOIN pruebas p ON r.id_prueba = p.id_prueba
  JOIN tiempos_minimos tm ON tm.id_prueba = r.id_prueba 
    AND tm.id_categoria = n.id_categoria
  WHERE ...
  ```

---

## 핵심 쿼리 정리

### 1. 카테고리 자동 계산
```sql
SELECT id_categoria 
FROM categorias 
WHERE ? BETWEEN edad_minima AND edad_maxima
```
> PHP에서 생년월일로 나이 계산 후 쿼리 실행

### 2. 납부 트랜잭션
```php
$pdo->beginTransaction();
try {
    // 1. 납부 기록 추가
    $stmt = $pdo->prepare("INSERT INTO pagos (id_nadador, fecha_pago, cantidad, mes_pagado) VALUES (?, ?, ?, ?)");
    $stmt->execute([...]);
    
    // 2. 선수 테이블 업데이트
    $stmt = $pdo->prepare("UPDATE nadadores SET ultimo_mes_pagado = ? WHERE id_nadador = ?");
    $stmt->execute([...]);
    
    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollBack();
}
```

### 3. 대회별 선수 수 조회 (GROUP BY + HAVING)
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

### 4. 기록 비교 리포트 (4 Tables JOIN)
```sql
SELECT 
    n.id_nadador,
    CONCAT(n.nombre, ' ', n.apellidos) AS nombre_completo,
    cat.nombre AS categoria,
    p.nombre AS prueba,
    comp.nombre AS competicion,
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
ORDER BY n.apellidos, n.nombre, comp.fecha
```

---

## 프로젝트 구조 (제안)

```
natacion_club/
├── config/
│   └── database.php          # PDO 연결 설정
├── includes/
│   ├── auth.php              # 인증 함수
│   └── functions.php         # 공통 함수
├── public/
│   ├── index.php             # 메인 페이지
│   ├── login.php             # 로그인
│   ├── logout.php            # 로그아웃
│   ├── nadadores/
│   │   ├── index.php         # 선수 목록
│   │   ├── create.php        # 선수 등록
│   │   ├── edit.php          # 선수 수정
│   │   └── delete.php        # 선수 삭제
│   ├── pagos/
│   │   ├── index.php         # 납부 목록
│   │   └── create.php        # 납부 등록
│   ├── competiciones/
│   │   ├── index.php         # 대회 목록
│   │   └── filter.php        # 대회 필터
│   └── reportes/
│       └── tiempos.php       # 기록 비교 리포트
├── assets/
│   └── css/
│       └── style.css         # Tailwind CSS
└── sql/
    ├── schema.sql            # 테이블 생성
    └── seed.sql              # 초기 데이터
```

---

## 참고사항

### 시간 저장 형식
- `DECIMAL(8,2)` 사용 (초 단위)
- 예: 25.34초 → 25.34, 1분 30.50초 → 90.50
- 표시할 때 MM:SS.ms 형식으로 변환

### 보안 체크리스트
- [ ] 모든 사용자 입력에 Prepared Statements 적용
- [ ] 비밀번호 `password_hash()` / `password_verify()` 사용
- [ ] 세션 기반 인증
- [ ] 역할별 페이지 접근 제어

---

*문서 생성일: 2026-01-09*
