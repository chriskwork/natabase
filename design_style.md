# NATABASE 수영 클럽 - 디자인 스타일 가이드

> Tailwind CSS 기반 디자인 시스템 문서

---

## 1. 컬러 팔레트

### 1.1 Primary Colors (브랜드 컬러)

로고에서 추출한 메인 브랜드 컬러:

| 색상 이름 | Hex Code | 용도 | Tailwind 클래스 |
|---------|----------|------|----------------|
| **Navy** | `#1a3a52` | 메인 텍스트, 헤더, 네비게이션, 다크 엘리먼트 | `bg-brand-navy`, `text-brand-navy` |
| **Turquoise** | `#0099cc` | 버튼, 링크, CTA, 하이라이트, 호버 효과 | `bg-brand-turquoise`, `text-brand-turquoise` |
| **Light Blue** | `#87ceeb` | 보조 하이라이트, 아이콘, 배지 | `bg-brand-lightblue`, `text-brand-lightblue` |

### 1.2 Semantic Colors (기능별 컬러)

시스템 상태와 피드백을 위한 컬러:

| 색상 이름 | Hex Code | 용도 | Tailwind 클래스 |
|---------|----------|------|----------------|
| **Success** | `#10b981` | 결제 완료, 성공 메시지, 금액 표시, 완료 상태 | `bg-emerald-500`, `text-emerald-500` |
| **Warning** | `#f59e0b` | 경고 메시지, 미납금, 주의사항, 대기 상태 | `bg-amber-500`, `text-amber-500` |
| **Error** | `#ef4444` | 에러 메시지, 실패 상태, 삭제 버튼 | `bg-red-500`, `text-red-500` |
| **Info** | `#6b7280` | 일반 정보, 비활성화 상태, 보조 텍스트 | `bg-gray-500`, `text-gray-500` |

### 1.3 Neutral Colors (배경 및 텍스트)

#### Light Mode (기본)

| 색상 이름 | Hex Code | 용도 | Tailwind 클래스 |
|---------|----------|------|----------------|
| **Background** | `#f8fafb` | 페이지 배경 | `bg-gray-50` |
| **Surface** | `#ffffff` | 카드, 모달, 컨테이너 | `bg-white` |
| **Text Primary** | `#1a3a52` | 주요 텍스트, 헤딩 | `text-brand-navy` |
| **Text Secondary** | `#6b7280` | 보조 텍스트, 설명 | `text-gray-500` |
| **Border** | `#e5e7eb` | 테두리, 구분선, 아웃라인 | `border-gray-200` |

#### Dark Mode

| 색상 이름 | Hex Code | 용도 | Tailwind 클래스 |
|---------|----------|------|----------------|
| **Background** | `#0f1419` | 페이지 배경 | `dark:bg-gray-950` |
| **Surface** | `#1a2332` | 카드, 모달, 컨테이너 | `dark:bg-gray-900` |
| **Text Primary** | `#f8fafb` | 주요 텍스트, 헤딩 | `dark:text-gray-50` |
| **Text Secondary** | `#9ca3af` | 보조 텍스트, 설명 | `dark:text-gray-400` |
| **Border** | `#374151` | 테두리, 구분선, 아웃라인 | `dark:border-gray-700` |

---

## 2. Tailwind 커스텀 설정

### 2.1 `tailwind.config.js` 설정

프로젝트 루트에 `tailwind.config.js` 파일을 생성하고 다음 설정을 추가:

```javascript
/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./views/**/*.php",
    "./public/**/*.{html,js}",
    "./includes/**/*.php"
  ],
  darkMode: 'class', // 다크 모드 활성화 (class 기반)
  theme: {
    extend: {
      colors: {
        // 브랜드 컬러
        'brand': {
          'navy': '#1a3a52',
          'turquoise': '#0099cc',
          'lightblue': '#87ceeb',
        },
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
        heading: ['Poppins', 'system-ui', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
```

### 2.2 CSS 입력 파일 (`public/assets/css/input.css`)

```css
@import 'tailwindcss';

/* 커스텀 스타일 (필요시) */
@layer base {
  body {
    @apply bg-gray-50 dark:bg-gray-950 text-brand-navy dark:text-gray-50;
  }
}

@layer components {
  /* 커스텀 컴포넌트 클래스는 여기에 추가 */
}
```

### 2.3 빌드 명령어

```bash
# CSS 빌드 (개발)
npx tailwindcss -i ./public/assets/css/input.css -o ./public/assets/css/output.css --watch

# CSS 빌드 (프로덕션)
npx tailwindcss -i ./public/assets/css/input.css -o ./public/assets/css/output.css --minify
```

---

## 3. 컴포넌트 디자인 규칙

### 3.1 버튼

#### Primary Button (주요 액션)
```html
<button class="px-6 py-3 bg-brand-turquoise hover:bg-[#0088b3] text-white font-semibold rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
  로그인
</button>
```

#### Secondary Button (보조 액션)
```html
<button class="px-6 py-3 bg-brand-navy hover:bg-[#142a3d] text-white font-semibold rounded-lg transition-colors duration-200">
  취소
</button>
```

#### Outline Button
```html
<button class="px-6 py-3 border-2 border-brand-turquoise text-brand-turquoise hover:bg-brand-turquoise hover:text-white font-semibold rounded-lg transition-all duration-200">
  자세히 보기
</button>
```

#### Danger Button
```html
<button class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition-colors duration-200">
  삭제
</button>
```

### 3.2 타이포그래피

#### 헤딩
```html
<h1 class="text-4xl font-bold text-brand-navy dark:text-gray-50 mb-4">Main Heading</h1>
<h2 class="text-3xl font-bold text-brand-navy dark:text-gray-50 mb-3">Section Heading</h2>
<h3 class="text-2xl font-semibold text-brand-navy dark:text-gray-50 mb-2">Subsection</h3>
<h4 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">Card Title</h4>
```

#### 본문
```html
<p class="text-base text-gray-700 dark:text-gray-300 leading-relaxed">일반 텍스트</p>
<p class="text-sm text-gray-500 dark:text-gray-400">보조 설명 텍스트</p>
<p class="text-xs text-gray-400 dark:text-gray-500">메타 정보 텍스트</p>
```

#### 링크
```html
<a href="#" class="text-brand-turquoise hover:text-[#0088b3] underline transition-colors">
  링크 텍스트
</a>
```

### 3.3 카드 / 컨테이너

#### 기본 카드
```html
<div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700">
  <h3 class="text-xl font-semibold text-brand-navy dark:text-gray-50 mb-4">카드 제목</h3>
  <p class="text-gray-700 dark:text-gray-300">카드 내용</p>
</div>
```

#### 하이라이트 카드 (강조)
```html
<div class="bg-gradient-to-br from-brand-turquoise to-brand-lightblue text-white rounded-lg shadow-lg p-6">
  <h3 class="text-xl font-semibold mb-4">특별 안내</h3>
  <p>강조할 내용</p>
</div>
```

#### 통계 카드
```html
<div class="bg-white dark:bg-gray-900 rounded-lg shadow-sm p-6 border-l-4 border-brand-turquoise">
  <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">등록 회원</p>
  <p class="text-3xl font-bold text-brand-navy dark:text-gray-50">127명</p>
</div>
```

### 3.4 폼 입력 필드

#### 텍스트 입력
```html
<div class="mb-4">
  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
    이름
  </label>
  <input
    type="text"
    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-turquoise focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
    placeholder="이름을 입력하세요"
  />
</div>
```

#### 에러 상태
```html
<div class="mb-4">
  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
    DNI
  </label>
  <input
    type="text"
    class="w-full px-4 py-2 border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 bg-red-50 dark:bg-red-900/20 text-gray-900 dark:text-gray-100"
    placeholder="12345678A"
  />
  <p class="text-sm text-red-500 mt-1">유효하지 않은 DNI입니다</p>
</div>
```

#### 선택 박스
```html
<select class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-turquoise bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
  <option>카테고리 선택</option>
  <option>Pre-Benjamín</option>
  <option>Benjamín</option>
</select>
```

### 3.5 상태 배지

#### 성공 (결제 완료)
```html
<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300">
  결제 완료
</span>
```

#### 경고 (미납)
```html
<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300">
  미납
</span>
```

#### 에러 (만료)
```html
<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
  만료됨
</span>
```

#### 정보 (대기)
```html
<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300">
  대기 중
</span>
```

### 3.6 네비게이션 바

```html
<nav class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 shadow-sm">
  <div class="container mx-auto px-4 py-4 flex items-center justify-between">
    <!-- 로고 -->
    <div class="flex items-center space-x-2">
      <img src="/public/assets/imgs/logo.png" alt="NATABASE" class="h-10" />
    </div>

    <!-- 메뉴 -->
    <div class="flex items-center space-x-6">
      <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-brand-turquoise transition-colors">
        회원 관리
      </a>
      <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-brand-turquoise transition-colors">
        결제 관리
      </a>
      <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-brand-turquoise transition-colors">
        대회 관리
      </a>
      <button class="px-4 py-2 bg-brand-turquoise text-white rounded-lg hover:bg-[#0088b3] transition-colors">
        로그아웃
      </button>
    </div>
  </div>
</nav>
```

### 3.7 테이블

```html
<div class="overflow-x-auto">
  <table class="w-full">
    <thead class="bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
      <tr>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
          이름
        </th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
          DNI
        </th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
          상태
        </th>
      </tr>
    </thead>
    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
      <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">김수영</td>
        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">12345678A</td>
        <td class="px-6 py-4 text-sm">
          <span class="px-3 py-1 rounded-full text-xs bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300">
            활성
          </span>
        </td>
      </tr>
    </tbody>
  </table>
</div>
```

---

## 4. 다크 모드 구현

### 4.1 다크 모드 토글 버튼

```html
<!-- HTML -->
<button
  id="theme-toggle"
  class="p-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
  aria-label="테마 전환"
>
  <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
  </svg>
  <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
  </svg>
</button>
```

### 4.2 JavaScript (다크 모드 토글)

```javascript
// public/assets/js/theme-toggle.js

// 페이지 로드 시 저장된 테마 적용
if (localStorage.getItem('color-theme') === 'dark' ||
    (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
  document.documentElement.classList.add('dark');
} else {
  document.documentElement.classList.remove('dark');
}

// 아이콘 표시 업데이트
const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

if (localStorage.getItem('color-theme') === 'dark' ||
    (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
  themeToggleLightIcon.classList.remove('hidden');
} else {
  themeToggleDarkIcon.classList.remove('hidden');
}

// 토글 버튼 이벤트
const themeToggleBtn = document.getElementById('theme-toggle');

themeToggleBtn.addEventListener('click', function() {
  // 아이콘 토글
  themeToggleDarkIcon.classList.toggle('hidden');
  themeToggleLightIcon.classList.toggle('hidden');

  // 테마 토글
  if (localStorage.getItem('color-theme')) {
    if (localStorage.getItem('color-theme') === 'light') {
      document.documentElement.classList.add('dark');
      localStorage.setItem('color-theme', 'dark');
    } else {
      document.documentElement.classList.remove('dark');
      localStorage.setItem('color-theme', 'light');
    }
  } else {
    if (document.documentElement.classList.contains('dark')) {
      document.documentElement.classList.remove('dark');
      localStorage.setItem('color-theme', 'light');
    } else {
      document.documentElement.classList.add('dark');
      localStorage.setItem('color-theme', 'dark');
    }
  }
});
```

### 4.3 HTML Head에 스크립트 추가

```html
<!-- views/layouts/header.php -->
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NATABASE - 수영 클럽 관리 시스템</title>
  <link rel="stylesheet" href="/public/assets/css/output.css">

  <!-- 다크 모드 플래시 방지 -->
  <script>
    if (localStorage.getItem('color-theme') === 'dark' ||
        (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    }
  </script>
</head>
<body>
```

### 4.4 다크 모드 적용 팁

1. **모든 컴포넌트에 `dark:` 클래스 추가**
   - 배경: `bg-white dark:bg-gray-900`
   - 텍스트: `text-gray-900 dark:text-gray-100`
   - 테두리: `border-gray-200 dark:border-gray-700`

2. **이미지 밝기 조정**
   ```html
   <img src="..." class="dark:brightness-90" />
   ```

3. **그림자 조정**
   ```html
   <div class="shadow-md dark:shadow-gray-800/50">
   ```

4. **호버 효과도 다크 모드 고려**
   ```html
   <button class="hover:bg-gray-100 dark:hover:bg-gray-800">
   ```

---

## 5. 반응형 디자인

### 5.1 브레이크포인트

Tailwind 기본 브레이크포인트 사용:

- `sm:` - 640px 이상
- `md:` - 768px 이상
- `lg:` - 1024px 이상
- `xl:` - 1280px 이상
- `2xl:` - 1536px 이상

### 5.2 반응형 예시

```html
<!-- 모바일: 세로 배치, 데스크톱: 가로 배치 -->
<div class="flex flex-col lg:flex-row gap-4">
  <div class="w-full lg:w-1/2">왼쪽 콘텐츠</div>
  <div class="w-full lg:w-1/2">오른쪽 콘텐츠</div>
</div>

<!-- 모바일: 작은 텍스트, 데스크톱: 큰 텍스트 -->
<h1 class="text-2xl md:text-4xl font-bold">제목</h1>

<!-- 모바일: 숨김, 데스크톱: 표시 -->
<div class="hidden lg:block">데스크톱 전용 콘텐츠</div>
```

---

## 6. 아이콘 사용 권장사항

### 6.1 권장 아이콘 라이브러리

- **Heroicons** (Tailwind 제작팀 제공): https://heroicons.com/
- **Feather Icons**: https://feathericons.com/
- **Phosphor Icons**: https://phosphoricons.com/

### 6.2 아이콘 컬러

```html
<!-- 브랜드 컬러 아이콘 -->
<svg class="w-6 h-6 text-brand-turquoise">...</svg>

<!-- 다크 모드 지원 아이콘 -->
<svg class="w-6 h-6 text-gray-700 dark:text-gray-300">...</svg>
```

---

## 7. 스페이싱 가이드

### 7.1 일관성 있는 여백

- 작은 여백: `space-y-2` (0.5rem / 8px)
- 중간 여백: `space-y-4` (1rem / 16px)
- 큰 여백: `space-y-6` (1.5rem / 24px)
- 섹션 구분: `space-y-8` (2rem / 32px)

### 7.2 패딩

- 버튼: `px-6 py-3`
- 카드: `p-6`
- 컨테이너: `px-4 lg:px-8`

---

## 8. 애니메이션 & 트랜지션

### 8.1 기본 트랜지션

```html
<!-- 컬러 변화 -->
<button class="transition-colors duration-200">

<!-- 전체 속성 -->
<div class="transition-all duration-300">

<!-- 그림자 변화 -->
<div class="transition-shadow duration-200">
```

### 8.2 호버 효과

```html
<!-- 확대 효과 -->
<div class="hover:scale-105 transition-transform">

<!-- 투명도 변화 -->
<div class="hover:opacity-80 transition-opacity">
```

---

## 9. 접근성 (Accessibility)

### 9.1 필수 사항

1. **의미 있는 HTML 태그 사용**
   ```html
   <button> (X <div onclick="">)
   <nav>, <main>, <header>, <footer>
   ```

2. **ARIA 레이블**
   ```html
   <button aria-label="메뉴 열기">
   <input aria-describedby="error-message">
   ```

3. **포커스 표시**
   ```html
   <button class="focus:outline-none focus:ring-2 focus:ring-brand-turquoise">
   ```

4. **충분한 색상 대비**
   - 텍스트: 최소 4.5:1
   - 큰 텍스트: 최소 3:1

---

## 10. 브랜드 아이덴티티 요약

### 핵심 가치
- **프로페셔널**: 신뢰감 있는 딥 네이비
- **활기참**: 상쾌한 터콰이즈 악센트
- **수영 관련**: 물과 바다를 연상시키는 블루 계열
- **차별화**: 밝은 터콰이즈로 다른 수영 클럽과 구분

### 디자인 원칙
1. **단순함**: 불필요한 장식 최소화
2. **일관성**: 모든 페이지에서 동일한 컴포넌트 스타일
3. **가독성**: 충분한 여백과 명확한 타이포그래피
4. **반응형**: 모든 디바이스에서 최적화된 경험

---

## 문서 버전
- **버전**: 1.0
- **작성일**: 2026-01-14
- **작성자**: NATABASE 개발팀
- **Tailwind CSS**: v4.1.18
