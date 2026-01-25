# Index (Landing Page) - 콘텐츠 기획서

> **하이브리드 구조**: 공개 랜딩 페이지는 index.php 하나에 앵커 스크롤 방식
> Nav, Hero 섹션은 이미 완성됨

---

## 페이지 구조 개요

```
index.php (공개 - 앵커 스크롤)
├── [Nav] - 완료
├── [Hero] - 완료
├── #sobre-nosotros - 클럽 소개
├── #programas - 프로그램/카테고리
├── #cifras - 통계
├── #eventos - 대회 미리보기
├── #precios - 가격
├── #contacto - 연락처/CTA
└── [Footer]
```

---

## Navbar 링크 수정 필요

```html
<li><a href="#sobre-nosotros">El Club</a></li>
<li><a href="#programas">Actividades</a></li>
<li><a href="#eventos">Eventos</a></li>
<li><a href="#precios">Precios</a></li>
```

---

## 1. #sobre-nosotros (클럽 소개)

### 레이아웃
- 2컬럼: 왼쪽 텍스트, 오른쪽 이미지
- 아래에 3개 특징 카드

### 콘텐츠

**섹션 ID:** `id="sobre-nosotros"`

**섹션 타이틀:**
> "Formando campeones desde 2010"

**소개 텍스트:**
> "En NATABASE, combinamos la pasión por la natación con una metodología de entrenamiento de élite. Nuestro club ha formado a más de 500 nadadores, desde principiantes hasta competidores de nivel nacional."

**3가지 특징 카드:**

| 아이콘 | 타이틀 | 설명 |
|--------|--------|------|
| 🏅 | Entrenadores Certificados | Profesionales con experiencia nacional e internacional |
| 🏊 | Piscina Olímpica | Instalaciones de 50m con tecnología de última generación |
| 📊 | Seguimiento Personalizado | Análisis de tiempos y progreso individual |

---

## 2. #programas (프로그램/카테고리)

### 레이아웃
- 카드 그리드 (3-4열)
- 각 카드에 카테고리명, 연령대, 한 줄 설명

### 콘텐츠

**섹션 ID:** `id="programas"`

**섹션 타이틀:**
> "Un programa para cada etapa"

**섹션 설명:**
> "Programas adaptados a cada grupo de edad, desde los más pequeños hasta nadadores máster."

**카테고리 카드 (7개 - DB categorias 기반):**

| 카테고리 | 연령 | 한 줄 설명 |
|----------|------|-----------|
| Pre-Benjamín | 0-8 años | Iniciación acuática y primeras brazadas |
| Benjamín | 9-10 años | Perfeccionamiento de estilos básicos |
| Alevín | 11-12 años | Técnica avanzada y competición regional |
| Infantil | 13-14 años | Especialización y preparación intensiva |
| Junior | 15-18 años | Alto rendimiento y competición nacional |
| Absoluto | 19-24 años | Nivel competitivo máximo |
| Máster | 25+ años | Mantenimiento y competición adulta |

---

## 3. #cifras (통계/실적)

### 레이아웃
- 배경색 있는 섹션 (brand-navy)
- 4개 숫자 나란히 배치

### 콘텐츠

**섹션 ID:** `id="cifras"`

**섹션 타이틀:**
> "NATABASE en números"

**통계 카드 (4개):**

| 숫자 | 라벨 |
|------|------|
| 500+ | Nadadores formados |
| 50+ | Competiciones al año |
| 200+ | Medallas conseguidas |
| 15 | Años de experiencia |

---

## 4. #eventos (대회 미리보기)

### 레이아웃
- 2-3개 예정 대회 카드만 표시
- 전체 일정은 로그인 후 확인 유도

### 콘텐츠

**섹션 ID:** `id="eventos"`

**섹션 타이틀:**
> "Próximas Competiciones"

**대회 카드 (DB competiciones 기반 예시):**

| 날짜 | 대회명 | 장소 |
|------|--------|------|
| 15 Feb 2026 | Campeonato Regional de Invierno | Valencia |
| 20 Abr 2026 | Copa de Primavera | Madrid |
| 10 Jun 2026 | Campeonato Nacional Juvenil | Barcelona |

**CTA:**
> "¿Quieres participar? Hazte socio y accede al calendario completo"

---

## 5. #precios (가격)

### 레이아웃
- 2개 가격 카드 (Mensual, Anual)
- Anual에 "Más popular" 배지

### 콘텐츠

**섹션 ID:** `id="precios"`

**섹션 타이틀:**
> "Planes que se adaptan a ti"

### Plan Mensual
- **50€** /mes
- ✅ Acceso a todas las instalaciones
- ✅ Entrenamiento según categoría
- ✅ Seguimiento de tiempos
- ✅ Seguro deportivo
- Sin compromiso

### Plan Anual ⭐ (Más popular)
- **500€** /año (~~600€~~ Ahorra 100€)
- ✅ Todo lo del plan mensual
- ✅ 2 meses gratis
- ✅ Equipamiento incluido
- ✅ Prioridad en competiciones

**버튼:** "Hazte socio" → /registro.php

---

## 6. #contacto (연락처/CTA)

### 레이아웃
- 2컬럼: 왼쪽 연락처 정보, 오른쪽 CTA
- 배경색 또는 이미지 오버레이

### 콘텐츠

**섹션 ID:** `id="contacto"`

**섹션 타이틀:**
> "¿Listo para dar el salto?"

**연락처 정보:**

| 항목 | 정보 |
|------|------|
| 📍 Dirección | Calle Deportes, 123 - 46001 Valencia |
| 📞 Teléfono | +34 961 234 567 |
| ✉️ Email | info@natabase.es |
| 🕐 Horario | L-V: 7:00-21:00 / S: 8:00-14:00 |

**CTA 버튼:**
- Primary: "Hazte socio" → /registro.php
- Secondary: "Iniciar sesión" → /login.php

---

## 7. Footer

### 콘텐츠

**3컬럼 구조:**

| NATABASE | Enlaces | Síguenos |
|----------|---------|----------|
| Logo | Iniciar sesión | @natabase_club |
| Club de Natación | Hazte socio | /natabaseclub |
| Valencia, España | Privacidad | @natabase |

**Copyright:**
> "© 2026 NATABASE Club de Natación. Todos los derechos reservados."

---

## HTML 구조 요약

```html
<nav>
  <a href="#sobre-nosotros">El Club</a>
  <a href="#programas">Actividades</a>
  <a href="#eventos">Eventos</a>
  <a href="#precios">Precios</a>
</nav>

<section id="hero">...</section>           <!-- 완료 -->
<section id="sobre-nosotros">...</section>  <!-- 클럽 소개 -->
<section id="programas">...</section>       <!-- 프로그램 -->
<section id="cifras">...</section>          <!-- 통계 -->
<section id="eventos">...</section>         <!-- 대회 -->
<section id="precios">...</section>         <!-- 가격 -->
<section id="contacto">...</section>        <!-- 연락처 -->
<footer>...</footer>
```

---

## 스무스 스크롤

```css
html {
  scroll-behavior: smooth;
}
```

---

## 디자인 참고

### 색상
- `brand-navy`: 메인 텍스트, 통계 섹션 배경
- `brand-turquoise`: 액센트, 링크 호버
- `brand-point` (오렌지): CTA 버튼

### 간격
- 각 섹션: `py-16` 또는 `py-20`
- 컨테이너: `container mx-auto px-4`

---

_작성일: 2026-01-25_
_수정일: 2026-01-25 (앵커 스크롤 방식으로 통합)_
