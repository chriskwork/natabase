# 🧭 NATABASE 랜딩페이지 네비게이션 메뉴 구성

## 📋 개요

**목적**: 신규 회원 유치를 위한 마케팅 랜딩페이지
**타겟**: 수영 클럽 가입을 고려하는 잠재 고객 (가족/성인)
**디자인**: Tailwind CSS 기반, 브랜드 컬러 사용

---

## 🎯 네비게이션 구조

### 1. 로고 영역 (좌측)
```
[NATABASE 로고]
```
- 이미지: `/public/assets/imgs/logo.png`
- 클릭 시: 홈페이지 최상단으로 이동
- 크기: 모바일 h-10, 데스크톱 h-12

### 2. 메인 메뉴 (중앙)
```
클럽 소개  |  프로그램  |  요금 안내  |  회원가입
```

| 메뉴 | 링크 | 설명 |
|------|------|------|
| **클럽 소개** | `#about` | 수영 클럽의 비전, 미션, 역사, 시설, 코치진 소개 |
| **프로그램** | `#programs` | 카테고리별 프로그램 (Pre-Benjamín ~ Máster), 훈련 코스, 대회 참가 정보 |
| **요금 안내** | `#pricing` | 월간 회원권 (50 EUR), 연간 회원권 (500 EUR), 일회성 비용 |
| **회원가입** | 별도 페이지 | 성인 선수 등록 또는 보호자 등록 페이지로 이동 |

### 3. CTA 버튼 영역 (우측)
```
[회원가입]  [로그인]
```

| 버튼 | 타입 | 스타일 | 링크 |
|------|------|--------|------|
| **회원가입** | Primary | 터콰이즈 배경 (#0099cc) | `/register.php` 또는 회원가입 선택 페이지 |
| **로그인** | Secondary | 네이비 테두리, 투명 배경 | `/login.php` |

---

## 📐 레이아웃

### Desktop (1024px+)
```
┌─────────────────────────────────────────────────────────────────┐
│                                                                   │
│  [LOGO]   클럽 소개  프로그램  요금 안내  회원가입   [회원가입] [로그인] │
│                                                                   │
└─────────────────────────────────────────────────────────────────┘
```

### Mobile (< 768px)
```
┌────────────────────────────┐
│                            │
│  [LOGO]          [☰ 메뉴]  │
│                            │
└────────────────────────────┘
```
- 햄버거 메뉴 클릭 시: 전체 화면 오버레이 메뉴 표시
- 모바일 메뉴 포함 항목: 모든 메뉴 링크 + CTA 버튼

---

## 🎨 브랜드 컬러

| 색상 | Hex Code | 용도 |
|------|----------|------|
| **Navy** | `#1a3a52` | 메인 텍스트, 로고, Secondary 버튼 |
| **Turquoise** | `#0099cc` | Primary 버튼, 링크 호버 |
| **Light Blue** | `#87ceeb` | 보조 하이라이트 |

---

## ⚙️ 주요 기능

### 1. Fixed Navigation
- 스크롤 시 상단에 고정
- 스크롤 20px 이상 시 그림자 효과 추가

### 2. Smooth Scroll
- 메뉴 클릭 시 해당 섹션으로 부드럽게 이동
- `scrollIntoView({ behavior: 'smooth' })` 사용

### 3. 반응형 디자인
- **Mobile**: < 768px - 햄버거 메뉴
- **Tablet**: 768px ~ 1023px - 간격 축소
- **Desktop**: 1024px+ - 전체 메뉴 표시

### 4. 다크 모드 지원
- 배경: `bg-white dark:bg-gray-900`
- 텍스트: `text-gray-700 dark:text-gray-300`
- 테두리: `border-gray-200 dark:border-gray-700`

---

## 🎭 스타일 예시

### 네비게이션 바
```html
<nav class="fixed top-0 w-full bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 shadow-sm z-50">
  <div class="container mx-auto px-4 lg:px-8 py-4 flex items-center justify-between">
    <!-- 내용 -->
  </div>
</nav>
```

### 메뉴 링크
```html
<a href="#about"
   class="text-gray-700 dark:text-gray-300 hover:text-brand-turquoise transition-colors font-medium">
  클럽 소개
</a>
```

### Primary 버튼 (회원가입)
```html
<a href="/register.php"
   class="px-6 py-3 bg-brand-turquoise hover:bg-[#0088b3] text-white font-semibold rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
  회원가입
</a>
```

### Secondary 버튼 (로그인)
```html
<a href="/login.php"
   class="px-6 py-3 border-2 border-brand-navy text-brand-navy hover:bg-brand-navy hover:text-white font-semibold rounded-lg transition-all duration-200">
  로그인
</a>
```

---

## 📂 구현 파일

| 파일 | 경로 | 설명 |
|------|------|------|
| **메인 페이지** | `/index.php` | 랜딩페이지 메인 파일 |
| **네비게이션** | `/views/layouts/navbar_landing.php` | 네비게이션 컴포넌트 |
| **모바일 메뉴 JS** | `/public/assets/js/mobile-menu.js` | 햄버거 메뉴 토글 |
| **다크 모드 JS** | `/public/assets/js/theme-toggle.js` | 다크 모드 전환 |
| **스타일시트** | `/public/assets/css/output.css` | Tailwind CSS 빌드 결과 |

---

## 🔍 사용자 흐름

```
방문자 도착
   ↓
[히어로 섹션] - 첫 인상, 메인 CTA
   ↓
[클럽 소개] - 비전, 시설, 코치진
   ↓
[프로그램] - 카테고리별 프로그램 안내
   ↓
[요금 안내] - 월간/연간 회원권 가격
   ↓
[회원가입] - CTA 버튼 클릭 → 등록 페이지
   ↓
로그인 → 대시보드 (회원 전용)
```

---

## ✅ 장점

1. **명확한 CTA**: "회원가입" 버튼이 Primary 스타일로 시각적 강조
2. **직관적인 구조**: 4개 메뉴로 정보를 간결하게 전달
3. **반응형**: 모든 디바이스에서 최적의 사용자 경험
4. **브랜드 정체성**: 수영 클럽 이미지에 맞는 블루 계열 컬러
5. **접근성**: Fixed 네비게이션으로 언제든 메뉴 접근 가능

---

**작성일**: 2026-01-14
**기반 문서**: design_style.md, project_plan.md
**구현 계획**: /Users/yohankim/.claude/plans/snazzy-skipping-pony.md
