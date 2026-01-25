# 로그인 / 회원가입 - 콘텐츠 기획서

> 인증 관련 페이지 - 로그인, 회원가입, 비밀번호 찾기
> DB 참조: `usuarios` 테이블 (rol: entrenador, familia, nadador)

---

## 페이지 URL
- 로그인: `/login` 또는 `/iniciar-sesion`
- 회원가입: `/registro` 또는 `/hazte-socio`
- 비밀번호 찾기: `/recuperar-password`

---

# 1. 로그인 페이지 (Iniciar Sesión)

## 레이아웃
- 2컬럼: 왼쪽 이미지/일러스트, 오른쪽 폼
- 또는 중앙 정렬 카드 형식

## 콘텐츠

**타이틀:**
> "Bienvenido de nuevo"

**서브타이틀:**
> "Accede a tu cuenta NATABASE"

---

### 로그인 폼

| 필드 | 타입 | 플레이스홀더 | 필수 |
|------|------|--------------|------|
| Email | email | tu@email.com | ✅ |
| Contraseña | password | ••••••••• | ✅ |
| Recordarme | checkbox | Mantener sesión iniciada | ❌ |

**버튼:**
> "Iniciar sesión"

**보조 링크:**
- "¿Olvidaste tu contraseña?" → 비밀번호 찾기
- "¿No tienes cuenta? Regístrate" → 회원가입

---

### 에러 메시지 (예시)

| 상황 | 메시지 |
|------|--------|
| 이메일 없음 | "No existe una cuenta con este email" |
| 비밀번호 틀림 | "Contraseña incorrecta. Inténtalo de nuevo." |
| 계정 비활성 | "Tu cuenta está desactivada. Contacta con administración." |
| 빈 필드 | "Por favor, completa todos los campos" |

---

### 성공 후 리다이렉트

| 역할 | 리다이렉트 |
|------|-----------|
| entrenador | /dashboard (코치 대시보드) |
| familia | /mis-nadadores (자녀 목록) |
| nadador | /mi-perfil (내 프로필/기록) |

---

# 2. 회원가입 페이지 (Registro / Hazte Socio)

## 레이아웃
- 스텝 형식 (3단계) 또는 긴 단일 폼
- 진행 표시기 포함

## 콘텐츠

**타이틀:**
> "Únete a NATABASE"

**서브타이틀:**
> "Crea tu cuenta en menos de 2 minutos"

---

### Step 1: Tipo de Cuenta (계정 유형 선택)

**질문:**
> "¿Cómo te registras?"

| 옵션 | 아이콘 | 설명 |
|------|--------|------|
| Soy nadador | 🏊 | Quiero gestionar mi propio perfil y entrenamientos |
| Soy padre/madre | 👨‍👩‍👧 | Quiero inscribir y seguir el progreso de mi hijo/a |

**참고:** 코치(entrenador) 계정은 관리자가 생성

---

### Step 2: Datos Personales (개인 정보)

| 필드 | 타입 | 플레이스홀더 | 필수 |
|------|------|--------------|------|
| Nombre | text | Tu nombre | ✅ |
| Apellidos | text | Tus apellidos | ✅ |
| Email | email | tu@email.com | ✅ |
| Teléfono | tel | 612 345 678 | ✅ |
| Contraseña | password | Mínimo 8 caracteres | ✅ |
| Confirmar contraseña | password | Repite tu contraseña | ✅ |

**비밀번호 요구사항:**
- Mínimo 8 caracteres
- Al menos una mayúscula
- Al menos un número

---

### Step 3: Datos del Nadador (선수 정보) - familia 역할만

**설명:**
> "Añade los datos del nadador que quieres inscribir"

| 필드 | 타입 | 플레이스홀더 | 필수 |
|------|------|--------------|------|
| Nombre del nadador | text | Nombre | ✅ |
| Apellidos | text | Apellidos | ✅ |
| DNI | text | 12345678A | ✅ |
| Fecha de nacimiento | date | dd/mm/yyyy | ✅ |
| Email (opcional) | email | email del nadador | ❌ |

**카테고리 자동 계산:**
> "Según la fecha de nacimiento, el nadador pertenece a la categoría: **Alevín**"

---

### 약관 동의

| 체크박스 | 텍스트 |
|----------|--------|
| ✅ 필수 | Acepto los [Términos y Condiciones] y la [Política de Privacidad] |
| ❌ 선택 | Deseo recibir noticias y promociones por email |

---

### 완료 메시지

**타이틀:**
> "¡Registro completado!"

**메시지:**
> "Hemos enviado un email de confirmación a **tu@email.com**. Por favor, verifica tu cuenta para completar el registro."

**안내:**
> "Una vez verificado, podrás acceder a tu cuenta y completar el proceso de inscripción en nuestras oficinas."

**버튼:**
- "Ir al inicio" → 홈페이지
- "Iniciar sesión" → 로그인 (이메일 확인 후)

---

# 3. 비밀번호 찾기 페이지 (Recuperar Contraseña)

## 콘텐츠

**타이틀:**
> "¿Olvidaste tu contraseña?"

**서브타이틀:**
> "Te enviaremos un enlace para restablecerla"

---

### 폼

| 필드 | 타입 | 플레이스홀더 | 필수 |
|------|------|--------------|------|
| Email | email | tu@email.com | ✅ |

**버튼:**
> "Enviar enlace"

---

### 성공 메시지

> "Si existe una cuenta con ese email, recibirás un enlace para restablecer tu contraseña en los próximos minutos."

**보안 참고:** 계정 존재 여부를 노출하지 않음

---

### 새 비밀번호 설정 페이지

**타이틀:**
> "Crea una nueva contraseña"

| 필드 | 타입 | 필수 |
|------|------|------|
| Nueva contraseña | password | ✅ |
| Confirmar contraseña | password | ✅ |

**버튼:**
> "Guardar contraseña"

---

# 4. 대시보드 미리보기 (로그인 후)

## 역할별 메뉴 구조

### Entrenador (코치)

```
Dashboard
├── Nadadores (선수 목록/관리)
├── Pagos (납부 관리)
├── Competiciones (대회 관리)
├── Resultados (기록 입력)
└── Reportes (리포트)
```

### Familia (가족/보호자)

```
Dashboard
├── Mis Nadadores (내 자녀 목록)
├── Historial de Pagos (납부 내역)
├── Calendario (일정)
└── Resultados (기록 확인)
```

### Nadador (선수)

```
Dashboard
├── Mi Perfil (내 프로필)
├── Mis Tiempos (내 기록)
├── Competiciones (대회 일정)
└── Progreso (진척도)
```

---

# 5. UI/UX 고려사항

## 폼 디자인

- 라벨은 필드 위에 배치
- 에러 메시지는 필드 아래 빨간색
- 성공 피드백은 녹색 체크
- 비밀번호 보기/숨기기 토글 아이콘

## 접근성

- 모든 필드에 적절한 label 연결
- 에러 메시지에 aria-live 적용
- 키보드 네비게이션 지원
- 탭 순서 논리적 배치

## 보안

- CSRF 토큰 필수
- 비밀번호는 password_hash() 사용
- 로그인 시도 제한 (5회 실패 시 잠금)
- HTTPS 필수

---

## 섹션 순서 요약

### 로그인 페이지
```
[Logo + 타이틀]
    ↓
[로그인 폼]
    ↓
[비밀번호 찾기 링크]
    ↓
[회원가입 링크]
```

### 회원가입 페이지
```
[Logo + 타이틀]
    ↓
[Step 1: 계정 유형]
    ↓
[Step 2: 개인 정보]
    ↓
[Step 3: 선수 정보 (familia만)]
    ↓
[약관 동의]
    ↓
[완료 메시지]
```

---

_작성일: 2026-01-25_
