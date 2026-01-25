# 관리 페이지 (로그인 후) - 콘텐츠 기획서

> **별도 페이지**: 로그인 후 접근하는 관리 시스템
> DB CRUD, 트랜잭션, JOIN 쿼리 등 과제 핵심 기능

---

## 페이지 구조 개요

```
로그인 후 관리 페이지 (별도 PHP 파일)
├── /views/auth/
│   ├── login.php
│   └── registro.php
├── /views/nadadores/    (선수 CRUD)
│   ├── index.php       (목록)
│   ├── create.php      (등록)
│   ├── show.php        (상세)
│   └── edit.php        (수정)
├── /views/pagos/        (납부 관리)
│   ├── index.php       (목록)
│   └── create.php      (등록 - 트랜잭션)
├── /views/competiciones/ (대회 관리)
│   ├── index.php       (목록)
│   ├── create.php      (등록)
│   └── resultados.php  (결과 입력)
└── /views/reportes/     (리포트)
    └── index.php       (대시보드)
```

---

## 공통 레이아웃

### 관리자 Navbar (로그인 후)

```
[Logo] ─── Nadadores ─── Pagos ─── Competiciones ─── Reportes ─── [Usuario ▼] ─── [Cerrar sesión]
```

### 역할별 메뉴 표시

| 메뉴 | Entrenador | Familia | Nadador |
|------|------------|---------|---------|
| Nadadores | ✅ 전체 CRUD | ✅ 자녀만 조회 | ✅ 본인만 |
| Pagos | ✅ 전체 CRUD | ✅ 자녀만 조회 | ✅ 본인만 |
| Competiciones | ✅ 전체 CRUD | ✅ 조회만 | ✅ 조회만 |
| Reportes | ✅ 전체 | ❌ | ❌ |

---

# 1. Nadadores (선수 관리)

## 1.1 목록 페이지 (index.php)

### 레이아웃
- 검색/필터 바
- 테이블 형식 목록
- 페이지네이션

### 콘텐츠

**페이지 타이틀:**
> "Gestión de Nadadores"

**검색/필터:**
| 필터 | 타입 | 옵션 |
|------|------|------|
| Buscar | text | 이름, 성, DNI 검색 |
| Categoría | select | Pre-Benjamín ~ Máster |
| Estado pago | select | Al día / Pendiente |

**테이블 헤더:**
| DNI | Nombre | Apellidos | Categoría | Último pago | Acciones |
|-----|--------|-----------|-----------|-------------|----------|

**액션 버튼:**
- 👁️ Ver (상세)
- ✏️ Editar (수정)
- 🗑️ Eliminar (삭제)

**CTA:**
> "+ Nuevo Nadador" 버튼

---

## 1.2 등록 페이지 (create.php)

### 폼 필드

| 필드 | 타입 | 필수 | 설명 |
|------|------|------|------|
| DNI | text | ✅ | Spanish format (8숫자+1문자) |
| Nombre | text | ✅ | |
| Apellidos | text | ✅ | |
| Fecha de nacimiento | date | ✅ | 카테고리 자동 계산 |
| Email | email | ❌ | |
| Teléfono | tel | ❌ | |
| Vincular usuario | select | ❌ | 기존 사용자 연결 |

**자동 계산 표시:**
> "Según la fecha de nacimiento, pertenece a: **Alevín** (11-12 años)"

**버튼:**
- "Guardar" (저장)
- "Cancelar" (취소 → 목록)

---

## 1.3 상세 페이지 (show.php)

### 섹션

**기본 정보:**
| 항목 | 값 |
|------|-----|
| DNI | 12345678A |
| Nombre completo | Pablo Martínez Ruiz |
| Fecha de nacimiento | 15/05/2010 |
| Categoría | Alevín |
| Email | pablo@email.com |
| Teléfono | 612 345 678 |

**납부 상태:**
| Último mes pagado | Estado |
|-------------------|--------|
| 2026-01 | ✅ Al día |

**최근 기록 (resultados):**
| Competición | Prueba | Tiempo | Fecha |
|-------------|--------|--------|-------|
| Campeonato Regional | 50m Libre | 32.45 | 15/02/2026 |

---

# 2. Pagos (납부 관리)

## 2.1 목록 페이지 (index.php)

### 콘텐츠

**페이지 타이틀:**
> "Gestión de Pagos"

**필터:**
| 필터 | 옵션 |
|------|------|
| Nadador | 전체 / 선택 |
| Mes | 2026-01, 2026-02... |
| Tipo | Mensual / Anual / Único |

**테이블 헤더:**
| Fecha | Nadador | Cantidad | Tipo | Mes pagado | Acciones |

**미납자 알림 섹션:**
> "⚠️ 3 nadadores con pagos pendientes" [Ver lista]

---

## 2.2 등록 페이지 (create.php) - 트랜잭션

### 폼 필드

| 필드 | 타입 | 필수 | 설명 |
|------|------|------|------|
| Nadador | select | ✅ | 선수 드롭다운 |
| Fecha de pago | date | ✅ | 기본: 오늘 |
| Tipo de pago | radio | ✅ | Mensual(50€) / Anual(500€) / Único |
| Cantidad | number | ✅ | tipo에 따라 자동 입력 |
| Mes a pagar | month | ✅ | 2026-01 형식 |

**Tipo 선택 시 동작:**
- Mensual → Cantidad: 50€, ultimo_mes_pagado +1개월
- Anual → Cantidad: 500€, ultimo_mes_pagado +12개월
- Único → Cantidad: 직접 입력, ultimo_mes_pagado 변경 없음

**트랜잭션 안내:**
> "Este pago actualizará automáticamente el estado del nadador"

---

# 3. Competiciones (대회 관리)

## 3.1 목록 페이지 (index.php)

### 콘텐츠

**페이지 타이틀:**
> "Gestión de Competiciones"

**필터:**
| 필터 | 옵션 |
|------|------|
| Fecha | Desde - Hasta |
| Mín. participantes | 숫자 입력 |

**테이블 헤더:**
| Fecha | Nombre | Lugar | Participantes | Acciones |

**액션:**
- 👁️ Ver resultados
- ✏️ Editar
- ➕ Añadir resultados

---

## 3.2 등록 페이지 (create.php)

### 폼 필드

| 필드 | 타입 | 필수 |
|------|------|------|
| Nombre | text | ✅ |
| Fecha | date | ✅ |
| Lugar | text | ✅ |

---

## 3.3 결과 입력 (resultados.php)

### 폼 필드

| 필드 | 타입 | 필수 |
|------|------|------|
| Nadador | select | ✅ |
| Prueba | select | ✅ |
| Tiempo | text | ✅ (MM:SS.ms 형식) |

**시간 입력 예시:**
> "Formato: 01:32.45 (1분 32초 45)" → DB 저장: 92.45초

**UNIQUE 체크:**
> 같은 선수+대회+종목 조합이 이미 있으면 에러

---

# 4. Reportes (리포트)

## 4.1 대시보드 (index.php)

### 콘텐츠

**페이지 타이틀:**
> "Panel de Control"

**통계 카드 (4개):**
| 숫자 | 라벨 |
|------|------|
| 45 | Nadadores activos |
| 12 | Competiciones este año |
| 3 | Pagos pendientes |
| 85% | Tasa de asistencia |

**차트/그래프:**
- 월별 납부 현황 (막대)
- 카테고리별 선수 분포 (파이)

---

## 4.2 기록 비교 리포트

### 필터
| 필터 | 옵션 |
|------|------|
| Nadador | 전체 / 선택 |
| Categoría | 전체 / 선택 |
| Prueba | 전체 / 선택 |

### 결과 테이블 (4+ 테이블 JOIN)

| Nadador | Categoría | Prueba | Competición | Tiempo | Mínimo | Diferencia | Estado |
|---------|-----------|--------|-------------|--------|--------|------------|--------|
| Pablo Martínez | Alevín | 50m Libre | Regional | 32.45 | 30.00 | +2.45 | ❌ NO CUMPLE |
| Luis Fernández | Infantil | 50m Libre | Regional | 28.90 | 27.00 | +1.90 | ❌ NO CUMPLE |

---

# 5. 공통 UI 요소

## 알림/토스트 메시지

| 타입 | 예시 메시지 |
|------|-------------|
| ✅ Éxito | "Nadador registrado correctamente" |
| ❌ Error | "Error: El DNI ya existe en el sistema" |
| ⚠️ Advertencia | "Este nadador tiene pagos pendientes" |

## 확인 모달 (삭제 시)

> "¿Estás seguro de que quieres eliminar a **Pablo Martínez**?"
> "Esta acción no se puede deshacer."
> [Cancelar] [Eliminar]

## 빈 상태 (Empty State)

> "No hay nadadores registrados"
> "Añade el primer nadador para empezar"
> [+ Nuevo Nadador]

---

## 페이지별 권한 체크

```php
// 예시: nadadores/index.php
checkRole(['entrenador', 'familia', 'nadador']);

// entrenador: 전체 목록
// familia: 자녀만 (familia_nadador JOIN)
// nadador: 본인만 (id_usuario 매칭)
```

---

_작성일: 2026-01-25_
