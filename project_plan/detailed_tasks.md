# 🏊 Natación Club - 생초보를 위한 세분화된 작업 플랜

## 📋 현재 상황

- **Phase 1 완료**: 데이터베이스 스키마, 폴더 구조, 설정 파일 준비 완료
- **Phase 2부터 시작**: 실제 PHP 코드 구현 시작

---

## 🔐 Phase 2: 핵심 인증 시스템 구축 (세분화)

### 2.1 PDO 데이터베이스 연결 설정 (config/database.php)

#### Step 2.1.1: 기본 database.php 파일 생성
```
할 일:
1. config/database.php 파일 생성
2. DB 접속 정보 변수 설정 (host, dbname, user, password)
```

#### Step 2.1.2: PDO 연결 코드 작성
```
할 일:
1. try-catch 블록으로 PDO 연결 시도
2. UTF-8 인코딩 설정
3. 에러 모드를 EXCEPTION으로 설정
4. 연결 실패 시 에러 메시지 출력
```

#### Step 2.1.3: 연결 테스트
```
할 일:
1. 간단한 테스트 PHP 파일 생성
2. require_once로 database.php 불러오기
3. 브라우저에서 접속해서 연결 성공 확인
```

---

### 2.2 공통 레이아웃 파일 생성 (views/layouts/)

#### Step 2.2.1: header.php 생성
```
할 일:
1. views/layouts/header.php 파일 생성
2. <!DOCTYPE html>, <html>, <head> 태그 작성
3. Tailwind CSS CDN 링크 추가
4. <meta charset="UTF-8"> 추가
5. <body> 태그 시작
```

#### Step 2.2.2: footer.php 생성
```
할 일:
1. views/layouts/footer.php 파일 생성
2. </body>, </html> 태그로 닫기
3. 필요한 JavaScript CDN 추가
```

#### Step 2.2.3: navbar.php 생성 (기본)
```
할 일:
1. views/layouts/navbar.php 파일 생성
2. 기본 내비게이션 바 HTML 작성
3. 로고 이미지 링크 추가
4. 로그인/로그아웃 버튼 자리 만들기
```

---

### 2.3 로그인 폼 화면 만들기 (views/auth/login.php)

#### Step 2.3.1: 로그인 폼 HTML 작성
```
할 일:
1. views/auth/login.php 파일 생성
2. header.php include
3. 이메일 입력 <input type="email"> 작성
4. 비밀번호 입력 <input type="password"> 작성
5. 로그인 버튼 <button type="submit"> 작성
6. footer.php include
```

#### Step 2.3.2: Tailwind로 로그인 폼 스타일링
```
할 일:
1. 폼을 화면 중앙에 배치 (flex, justify-center, items-center)
2. 입력 필드에 테두리, 패딩 추가
3. 버튼에 배경색, 호버 효과 추가
4. 에러 메시지 표시 영역 추가
```

---

### 2.4 세션과 인증 기본 설정 (includes/)

#### Step 2.4.1: auth.php 파일 생성
```
할 일:
1. includes/auth.php 파일 생성
2. session_start() 호출
3. 로그인 여부 확인 함수 isLoggedIn() 작성
4. 현재 사용자 역할 확인 함수 getUserRole() 작성
```

#### Step 2.4.2: 권한 확인 함수 작성
```
할 일:
1. checkRole($allowedRoles) 함수 작성
2. 세션에서 사용자 역할 가져오기
3. 허용된 역할인지 확인
4. 권한 없으면 로그인 페이지로 리다이렉트
```

---

### 2.5 로그인 처리 로직 구현 (controllers/AuthController.php)

#### Step 2.5.1: AuthController 클래스 생성
```
할 일:
1. controllers/AuthController.php 파일 생성
2. <?php 태그로 시작
3. class AuthController { } 선언
4. database.php require_once
```

#### Step 2.5.2: login() 메서드 작성 - 폼 표시
```
할 일:
1. public function login() 메서드 생성
2. GET 요청이면 로그인 폼 화면 표시
3. views/auth/login.php include
```

#### Step 2.5.3: login() 메서드 작성 - 로그인 처리
```
할 일:
1. POST 요청 처리 로직 추가
2. $_POST에서 email, password 가져오기
3. email로 사용자 조회 SQL 작성 (Prepared Statement)
4. password_verify()로 비밀번호 확인
5. 세션에 사용자 정보 저장
6. 대시보드로 리다이렉트
```

#### Step 2.5.4: logout() 메서드 작성
```
할 일:
1. public function logout() 메서드 생성
2. session_destroy() 호출
3. 쿠키 삭제
4. 로그인 페이지로 리다이렉트
```

---

### 2.6 프론트 컨트롤러 설정 (public/index.php)

#### Step 2.6.1: 기본 라우팅 설정
```
할 일:
1. public/index.php 기존 내용 삭제
2. session_start() 추가
3. $_GET['action'] 파라미터로 페이지 구분
4. switch-case로 각 액션별 처리
```

#### Step 2.6.2: 라우트 추가
```
할 일:
1. 'login' → AuthController->login() 호출
2. 'logout' → AuthController->logout() 호출
3. 기본(default) → 홈페이지 또는 로그인 페이지
```

---

### 2.7 로그인 기능 테스트

#### Step 2.7.1: 테스트 사용자로 로그인 테스트
```
할 일:
1. 브라우저에서 localhost/public/index.php?action=login 접속
2. seed.sql에 있는 테스트 계정으로 로그인 시도
   - coach@example.com / password123
3. 로그인 성공/실패 확인
```

#### Step 2.7.2: 세션 확인
```
할 일:
1. 로그인 후 세션 변수 확인
2. 로그아웃 후 세션 삭제 확인
```

---

## 👤 Phase 3: 선수 관리 (CRUD) 기능 구현 (세분화)

### 3.1 Nadador 모델 생성 (models/Nadador.php)

#### Step 3.1.1: Nadador 클래스 기본 구조
```
할 일:
1. models/Nadador.php 파일 생성
2. class Nadador { } 선언
3. private $pdo 속성 추가
4. __construct($pdo) 생성자 작성
```

#### Step 3.1.2: getAll() 메서드 작성
```
할 일:
1. public function getAll() 메서드 생성
2. SELECT * FROM nadadores SQL 작성
3. JOIN으로 categorias 테이블 연결
4. 결과 배열로 반환
```

#### Step 3.1.3: getById() 메서드 작성
```
할 일:
1. public function getById($id) 메서드 생성
2. Prepared Statement로 WHERE id_nadador = ? 쿼리
3. 단일 결과 반환
```

#### Step 3.1.4: create() 메서드 작성
```
할 일:
1. public function create($data) 메서드 생성
2. INSERT INTO nadadores 쿼리 작성
3. Prepared Statement 사용
4. lastInsertId() 반환
```

#### Step 3.1.5: update() 메서드 작성
```
할 일:
1. public function update($id, $data) 메서드 생성
2. UPDATE nadadores SET ... WHERE id_nadador = ?
3. Prepared Statement 사용
```

#### Step 3.1.6: delete() 메서드 작성
```
할 일:
1. public function delete($id) 메서드 생성
2. DELETE FROM nadadores WHERE id_nadador = ?
3. Prepared Statement 사용
```

---

### 3.2 Categoria 모델 생성 (models/Categoria.php)

#### Step 3.2.1: Categoria 클래스 작성
```
할 일:
1. models/Categoria.php 파일 생성
2. getAll() - 모든 카테고리 조회
3. getCategoriaByAge($age) - 나이로 카테고리 찾기
```

---

### 3.3 DNI 검증 함수 작성 (includes/validation.php)

#### Step 3.3.1: validation.php 파일 생성
```
할 일:
1. includes/validation.php 파일 생성
2. validateDNI($dni) 함수 작성
3. 형식 검사: 8자리 숫자 + 1글자
4. 검증 문자 확인 (modulo 23 계산)
```

#### Step 3.3.2: DNI 중복 확인 함수
```
할 일:
1. isDNIUnique($pdo, $dni, $excludeId = null) 함수 작성
2. SELECT COUNT(*) FROM nadadores WHERE dni = ?
3. 수정 시에는 자기 자신 제외
```

---

### 3.4 NadadoresController 생성 (controllers/NadadoresController.php)

#### Step 3.4.1: 컨트롤러 기본 구조
```
할 일:
1. controllers/NadadoresController.php 파일 생성
2. class NadadoresController 선언
3. Nadador, Categoria 모델 불러오기
```

#### Step 3.4.2: index() 메서드 - 선수 목록
```
할 일:
1. public function index() 메서드 생성
2. Nadador->getAll() 호출
3. views/nadadores/index.php에 데이터 전달
```

#### Step 3.4.3: create() 메서드 - 선수 등록
```
할 일:
1. public function create() 메서드 생성
2. GET: 등록 폼 표시
3. POST: 입력값 검증 → DNI 검증 → 카테고리 자동 계산 → DB 저장
```

#### Step 3.4.4: edit() 메서드 - 선수 수정
```
할 일:
1. public function edit($id) 메서드 생성
2. GET: 기존 데이터 로드 → 수정 폼 표시
3. POST: 입력값 검증 → 업데이트
```

#### Step 3.4.5: delete() 메서드 - 선수 삭제
```
할 일:
1. public function delete($id) 메서드 생성
2. 확인 메시지 표시
3. 삭제 실행
```

---

### 3.5 선수 관리 뷰 파일 생성 (views/nadadores/)

#### Step 3.5.1: index.php - 선수 목록 화면
```
할 일:
1. views/nadadores/index.php 파일 생성
2. 테이블로 선수 목록 표시
3. 각 행에 수정/삭제 버튼 추가
4. "새 선수 등록" 버튼 추가
```

#### Step 3.5.2: create.php - 선수 등록 폼
```
할 일:
1. views/nadadores/create.php 파일 생성
2. 입력 필드: nombre, apellidos, dni, fecha_nacimiento, email, telefono
3. 폼 검증 에러 메시지 표시 영역
4. 저장 버튼
```

#### Step 3.5.3: edit.php - 선수 수정 폼
```
할 일:
1. views/nadadores/edit.php 파일 생성
2. 기존 값을 input value에 채우기
3. 수정 버튼
```

---

### 3.6 카테고리 자동 계산 로직

#### Step 3.6.1: 나이 계산 함수
```
할 일:
1. calculateAge($birthDate) 함수 작성
2. 현재 연도 - 생년월일의 연도
3. 생일이 아직 안 지났으면 -1
```

#### Step 3.6.2: 카테고리 매칭 로직
```
할 일:
1. 나이로 categorias 테이블에서 해당 카테고리 조회
2. WHERE :edad BETWEEN edad_minima AND edad_maxima
3. id_categoria 반환
```

---

### 3.7 선수 관리 라우트 추가

#### Step 3.7.1: index.php에 선수 관련 라우트 추가
```
할 일:
1. 'nadadores' → NadadoresController->index()
2. 'nadadores/create' → NadadoresController->create()
3. 'nadadores/edit' → NadadoresController->edit($id)
4. 'nadadores/delete' → NadadoresController->delete($id)
```

---

## 💰 Phase 4: 납부 관리 시스템 구현 (세분화)

### 4.1 Pago 모델 생성 (models/Pago.php)

#### Step 4.1.1: Pago 클래스 기본 구조
```
할 일:
1. models/Pago.php 파일 생성
2. class Pago 선언
3. 기본 CRUD 메서드 작성
```

#### Step 4.1.2: 트랜잭션 납부 등록 메서드
```
할 일:
1. public function createWithTransaction($data) 메서드
2. beginTransaction()
3. INSERT INTO pagos
4. UPDATE nadadores.ultimo_mes_pagado (tipo_pago별 로직)
5. commit() 또는 rollBack()
```

---

### 4.2 PagosController 생성

#### Step 4.2.1: 컨트롤러 기본 구조
```
할 일:
1. controllers/PagosController.php 파일 생성
2. 기본 CRUD 메서드 작성
```

#### Step 4.2.2: create() 메서드 - 납부 등록
```
할 일:
1. 선수 선택 드롭다운
2. tipo_pago 라디오 버튼 (anual/mensual/unico)
3. 금액, 납부월 입력
4. 트랜잭션으로 저장
```

#### Step 4.2.3: morosos() 메서드 - 미납자 목록
```
할 일:
1. 미납자 조회 쿼리 작성
2. ultimo_mes_pagado가 한 달 이상 지난 선수
3. 뷰에 데이터 전달
```

---

### 4.3 납부 관리 뷰 파일 생성

#### Step 4.3.1: index.php - 납부 내역 목록
```
할 일:
1. views/pagos/index.php 파일 생성
2. 납부 내역 테이블
3. 선수별 필터
```

#### Step 4.3.2: create.php - 납부 등록 폼
```
할 일:
1. views/pagos/create.php 파일 생성
2. 선수 선택 드롭다운
3. tipo_pago 라디오 버튼
4. 금액, 날짜 입력
```

#### Step 4.3.3: morosos.php - 미납자 목록
```
할 일:
1. views/pagos/morosos.php 파일 생성
2. 미납 선수 목록 표시
3. 미납 개월 수 표시
```

---

## 🏆 Phase 5: 대회 및 기록 관리 (세분화)

### 5.1 Competicion 모델 생성

#### Step 5.1.1: 기본 CRUD 메서드
```
할 일:
1. models/Competicion.php 파일 생성
2. getAll(), getById(), create(), update(), delete()
```

---

### 5.2 Resultado 모델 생성

#### Step 5.2.1: 기본 CRUD 메서드
```
할 일:
1. models/Resultado.php 파일 생성
2. 기본 CRUD 메서드
3. 시간 형식 변환 함수 (MM:SS.ms ↔ 초)
```

---

### 5.3 CompeticionesController 생성

#### Step 5.3.1: 대회 CRUD
```
할 일:
1. controllers/CompeticionesController.php 파일 생성
2. index(), create(), edit(), delete() 메서드
```

#### Step 5.3.2: 대회별 선수 필터링
```
할 일:
1. filter() 메서드 - 최소 n명 이상 참가한 대회 조회
```

---

### 5.4 대회 관리 뷰 파일 생성

#### Step 5.4.1: 대회 목록, 등록, 수정 화면
```
할 일:
1. views/competiciones/index.php
2. views/competiciones/create.php
3. views/competiciones/edit.php
```

---

## 📊 Phase 6: 고급 리포트 및 분석 (세분화)

### 6.1 ReportesController 생성

#### Step 6.1.1: 기록 비교 리포트
```
할 일:
1. controllers/ReportesController.php 파일 생성
2. tiempos() 메서드 - 4개 테이블 JOIN 쿼리
```

#### Step 6.1.2: 코치 대시보드
```
할 일:
1. dashboard() 메서드
2. 전체 선수 수, 월별 납부율, 최근 대회 요약
```

---

### 6.2 리포트 뷰 파일 생성

#### Step 6.2.1: 기록 비교 화면
```
할 일:
1. views/reportes/tiempos.php
2. 필터 (선수별, 카테고리별)
3. 결과 테이블
```

---

## 🎨 Phase 7: UI/UX 개선 및 보안 강화 (세분화)

### 7.1 CSRF 토큰 구현

#### Step 7.1.1: CSRF 토큰 생성 함수
```
할 일:
1. generateCSRFToken() 함수 작성
2. 모든 폼에 hidden input으로 추가
```

#### Step 7.1.2: CSRF 토큰 검증 함수
```
할 일:
1. validateCSRFToken($token) 함수 작성
2. 모든 POST 요청에서 검증
```

---

### 7.2 XSS 방지

#### Step 7.2.1: 출력 이스케이프
```
할 일:
1. 모든 사용자 입력 출력 시 htmlspecialchars() 적용
2. 헬퍼 함수 e($string) 작성
```

---

### 7.3 Tailwind CSS 완성

#### Step 7.3.1: 공통 스타일 적용
```
할 일:
1. 모든 페이지에 일관된 스타일 적용
2. 반응형 디자인 확인
3. 에러/성공 메시지 스타일
```

---

## 🧪 Phase 8: 테스팅 및 최종 검토 (세분화)

### 8.1 기능 테스트

#### Step 8.1.1: 인증 테스트
```
할 일:
1. 3가지 역할로 로그인 테스트
2. 권한별 페이지 접근 테스트
3. 로그아웃 테스트
```

#### Step 8.1.2: 선수 CRUD 테스트
```
할 일:
1. 선수 등록 테스트 (DNI 검증 포함)
2. 선수 목록 조회 테스트
3. 선수 수정 테스트
4. 선수 삭제 테스트
```

#### Step 8.1.3: 납부 트랜잭션 테스트
```
할 일:
1. 정상 납부 등록 테스트
2. 에러 발생 시 롤백 테스트
3. tipo_pago별 로직 테스트
```

---

## ✅ 체크리스트 요약

### Phase 2 (인증) - 총 16개 세부 작업
- [ ] 2.1.1~2.1.3: DB 연결 (3개)
- [ ] 2.2.1~2.2.3: 레이아웃 (3개)
- [ ] 2.3.1~2.3.2: 로그인 폼 (2개)
- [ ] 2.4.1~2.4.2: 세션/인증 (2개)
- [ ] 2.5.1~2.5.4: AuthController (4개)
- [ ] 2.6.1~2.6.2: 라우팅 (2개)

### Phase 3 (선수 관리) - 총 15개 세부 작업
- [ ] 3.1.1~3.1.6: Nadador 모델 (6개)
- [ ] 3.2.1: Categoria 모델 (1개)
- [ ] 3.3.1~3.3.2: DNI 검증 (2개)
- [ ] 3.4.1~3.4.5: NadadoresController (5개)
- [ ] 3.5.1~3.5.3: 뷰 파일 (3개)
- [ ] 3.6.1~3.6.2: 카테고리 계산 (2개)
- [ ] 3.7.1: 라우트 (1개)

### Phase 4 (납부 관리) - 총 8개 세부 작업
- [ ] 4.1.1~4.1.2: Pago 모델 (2개)
- [ ] 4.2.1~4.2.3: PagosController (3개)
- [ ] 4.3.1~4.3.3: 뷰 파일 (3개)

### Phase 5 (대회/기록) - 총 6개 세부 작업
- [ ] 5.1~5.2: 모델 (2개)
- [ ] 5.3.1~5.3.2: Controller (2개)
- [ ] 5.4.1: 뷰 파일 (2개)

### Phase 6 (리포트) - 총 3개 세부 작업
- [ ] 6.1.1~6.1.2: ReportesController (2개)
- [ ] 6.2.1: 뷰 파일 (1개)

### Phase 7 (보안/UI) - 총 4개 세부 작업
- [ ] 7.1.1~7.1.2: CSRF (2개)
- [ ] 7.2.1: XSS 방지 (1개)
- [ ] 7.3.1: CSS 완성 (1개)

### Phase 8 (테스트) - 총 3개 세부 작업
- [ ] 8.1.1~8.1.3: 기능 테스트 (3개)

---

**총 세부 작업 수: 약 55개**

---

## 🚀 다음 단계

Phase 2부터 시작하여 Step 2.1.1 (database.php 생성)부터 하나씩 진행합니다.
