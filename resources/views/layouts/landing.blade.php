<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="http://localhost:5173/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&amp;family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer">


    <style type="text/css">
        @font-face {
            font-weight: 400;
            font-style: normal;
            font-family: circular;

            src: url('chrome-extension://liecbddmkiiihnedobmlmillhodjkdmb/fonts/CircularXXWeb-Book.woff2') format('woff2');
        }

        @font-face {
            font-weight: 700;
            font-style: normal;
            font-family: circular;

            src: url('chrome-extension://liecbddmkiiihnedobmlmillhodjkdmb/fonts/CircularXXWeb-Bold.woff2') format('woff2');
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style type="text/css" data-vite-dev-id="D:/KODING/Svelte.js/gym-page/src/app.css">
        /*
! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com
*/
        /*
1. Prevent padding and border from affecting element width. (https://github.com/mozdevs/cssremedy/issues/4)
2. Allow adding a border to an element by just adding a border-width. (https://github.com/tailwindcss/tailwindcss/pull/116)
*/

        *,
        ::before,
        ::after {
            box-sizing: border-box;
            /* 1 */
            border-width: 0;
            /* 2 */
            border-style: solid;
            /* 2 */
            border-color: #e5e7eb;
            /* 2 */
        }

        ::before,
        ::after {
            --tw-content: '';
        }

        /*
1. Use a consistent sensible line-height in all browsers.
2. Prevent adjustments of font size after orientation changes in iOS.
3. Use a more readable tab size.
4. Use the user's configured `sans` font-family by default.
5. Use the user's configured `sans` font-feature-settings by default.
6. Use the user's configured `sans` font-variation-settings by default.
7. Disable tap highlights on iOS
*/

        html,
        :host {
            line-height: 1.5;
            /* 1 */
            -webkit-text-size-adjust: 100%;
            /* 2 */
            -moz-tab-size: 4;
            /* 3 */
            -o-tab-size: 4;
            tab-size: 4;
            /* 3 */
            font-family: ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            /* 4 */
            font-feature-settings: normal;
            /* 5 */
            font-variation-settings: normal;
            /* 6 */
            -webkit-tap-highlight-color: transparent;
            /* 7 */
        }

        /*
1. Remove the margin in all browsers.
2. Inherit line-height from `html` so users can set them as a class directly on the `html` element.
*/

        body {
            margin: 0;
            /* 1 */
            line-height: inherit;
            /* 2 */
        }

        /*
1. Add the correct height in Firefox.
2. Correct the inheritance of border color in Firefox. (https://bugzilla.mozilla.org/show_bug.cgi?id=190655)
3. Ensure horizontal rules are visible by default.
*/

        hr {
            height: 0;
            /* 1 */
            color: inherit;
            /* 2 */
            border-top-width: 1px;
            /* 3 */
        }

        /*
Add the correct text decoration in Chrome, Edge, and Safari.
*/

        abbr:where([title]) {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted;
        }

        /*
Remove the default font size and weight for headings.
*/

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: inherit;
            font-weight: inherit;
        }

        /*
Reset links to optimize for opt-in styling instead of opt-out.
*/

        a {
            color: inherit;
            text-decoration: inherit;
        }

        /*
Add the correct font weight in Edge and Safari.
*/

        b,
        strong {
            font-weight: bolder;
        }

        /*
1. Use the user's configured `mono` font-family by default.
2. Use the user's configured `mono` font-feature-settings by default.
3. Use the user's configured `mono` font-variation-settings by default.
4. Correct the odd `em` font sizing in all browsers.
*/

        code,
        kbd,
        samp,
        pre {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            /* 1 */
            font-feature-settings: normal;
            /* 2 */
            font-variation-settings: normal;
            /* 3 */
            font-size: 1em;
            /* 4 */
        }

        /*
Add the correct font size in all browsers.
*/

        small {
            font-size: 80%;
        }

        /*
Prevent `sub` and `sup` elements from affecting the line height in all browsers.
*/

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline;
        }

        sub {
            bottom: -0.25em;
        }

        sup {
            top: -0.5em;
        }

        /*
1. Remove text indentation from table contents in Chrome and Safari. (https://bugs.chromium.org/p/chromium/issues/detail?id=999088, https://bugs.webkit.org/show_bug.cgi?id=201297)
2. Correct table border color inheritance in all Chrome and Safari. (https://bugs.chromium.org/p/chromium/issues/detail?id=935729, https://bugs.webkit.org/show_bug.cgi?id=195016)
3. Remove gaps between table borders by default.
*/

        table {
            text-indent: 0;
            /* 1 */
            border-color: inherit;
            /* 2 */
            border-collapse: collapse;
            /* 3 */
        }

        /*
1. Change the font styles in all browsers.
2. Remove the margin in Firefox and Safari.
3. Remove default padding in all browsers.
*/

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: inherit;
            /* 1 */
            font-feature-settings: inherit;
            /* 1 */
            font-variation-settings: inherit;
            /* 1 */
            font-size: 100%;
            /* 1 */
            font-weight: inherit;
            /* 1 */
            line-height: inherit;
            /* 1 */
            color: inherit;
            /* 1 */
            margin: 0;
            /* 2 */
            padding: 0;
            /* 3 */
        }

        /*
Remove the inheritance of text transform in Edge and Firefox.
*/

        button,
        select {
            text-transform: none;
        }

        /*
1. Correct the inability to style clickable types in iOS and Safari.
2. Remove default button styles.
*/

        button,
        [type='button'],
        [type='reset'],
        [type='submit'] {
            -webkit-appearance: button;
            /* 1 */
            background-color: transparent;
            /* 2 */
            background-image: none;
            /* 2 */
        }

        /*
Use the modern Firefox focus style for all focusable elements.
*/

        :-moz-focusring {
            outline: auto;
        }

        /*
Remove the additional `:invalid` styles in Firefox. (https://github.com/mozilla/gecko-dev/blob/2f9eacd9d3d995c937b4251a5557d95d494c9be1/layout/style/res/forms.css#L728-L737)
*/

        :-moz-ui-invalid {
            box-shadow: none;
        }

        /*
Add the correct vertical alignment in Chrome and Firefox.
*/

        progress {
            vertical-align: baseline;
        }

        /*
Correct the cursor style of increment and decrement buttons in Safari.
*/

        ::-webkit-inner-spin-button,
        ::-webkit-outer-spin-button {
            height: auto;
        }

        /*
1. Correct the odd appearance in Chrome and Safari.
2. Correct the outline style in Safari.
*/

        [type='search'] {
            -webkit-appearance: textfield;
            /* 1 */
            outline-offset: -2px;
            /* 2 */
        }

        /*
Remove the inner padding in Chrome and Safari on macOS.
*/

        ::-webkit-search-decoration {
            -webkit-appearance: none;
        }

        /*
1. Correct the inability to style clickable types in iOS and Safari.
2. Change font properties to `inherit` in Safari.
*/

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            /* 1 */
            font: inherit;
            /* 2 */
        }

        /*
Add the correct display in Chrome and Safari.
*/

        summary {
            display: list-item;
        }

        /*
Removes the default spacing and border for appropriate elements.
*/

        blockquote,
        dl,
        dd,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        hr,
        figure,
        p,
        pre {
            margin: 0;
        }

        fieldset {
            margin: 0;
            padding: 0;
        }

        legend {
            padding: 0;
        }

        ol,
        ul,
        menu {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        /*
Reset default styling for dialogs.
*/
        dialog {
            padding: 0;
        }

        /*
Prevent resizing textareas horizontally by default.
*/

        textarea {
            resize: vertical;
        }

        /*
1. Reset the default placeholder opacity in Firefox. (https://github.com/tailwindlabs/tailwindcss/issues/3300)
2. Set the default placeholder color to the user's configured gray 400 color.
*/

        input::-moz-placeholder,
        textarea::-moz-placeholder {
            opacity: 1;
            /* 1 */
            color: #9ca3af;
            /* 2 */
        }

        input::placeholder,
        textarea::placeholder {
            opacity: 1;
            /* 1 */
            color: #9ca3af;
            /* 2 */
        }

        /*
Set the default cursor for buttons.
*/

        button,
        [role="button"] {
            cursor: pointer;
        }

        /*
Make sure disabled buttons don't get the pointer cursor.
*/
        :disabled {
            cursor: default;
        }

        /*
1. Make replaced elements `display: block` by default. (https://github.com/mozdevs/cssremedy/issues/14)
2. Add `vertical-align: middle` to align replaced elements more sensibly by default. (https://github.com/jensimmons/cssremedy/issues/14#issuecomment-634934210)
   This can trigger a poorly considered lint error in some tools but is included by design.
*/

        img,
        svg,
        video,
        canvas,
        audio,
        iframe,
        embed,
        object {
            display: block;
            /* 1 */
            vertical-align: middle;
            /* 2 */
        }

        /*
Constrain images and videos to the parent width and preserve their intrinsic aspect ratio. (https://github.com/mozdevs/cssremedy/issues/14)
*/

        img,
        video {
            max-width: 100%;
            height: auto;
        }

        /* Make elements with the HTML hidden attribute stay hidden by default */
        [hidden] {
            display: none;
        }

        *,
        ::before,
        ::after {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia: ;
        }

        ::backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia: ;
        }

        .pointer-events-none {
            pointer-events: none;
        }

        .fixed {
            position: fixed;
        }

        .absolute {
            position: absolute;
        }

        .relative {
            position: relative;
        }

        .inset-0 {
            inset: 0px;
        }

        .left-0 {
            left: 0px;
        }

        .right-0 {
            right: 0px;
        }

        .top-0 {
            top: 0px;
        }

        .z-20 {
            z-index: 20;
        }

        .z-50 {
            z-index: 50;
        }

        .z-\[-1\] {
            z-index: -1;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .-ml-8 {
            margin-left: -2rem;
        }

        .-mr-8 {
            margin-right: -2rem;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .ml-2 {
            margin-left: 0.5rem;
        }

        .mr-auto {
            margin-right: auto;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .flex {
            display: flex;
        }

        .grid {
            display: grid;
        }

        .contents {
            display: contents;
        }

        .hidden {
            display: none;
        }

        .aspect-square {
            aspect-ratio: 1 / 1;
        }

        .h-2 {
            height: 0.5rem;
        }

        .h-2\/3 {
            height: 66.666667%;
        }

        .h-4 {
            height: 1rem;
        }

        .h-8 {
            height: 2rem;
        }

        .h-\[1\.5px\] {
            height: 1.5px;
        }

        .h-\[1px\] {
            height: 1px;
        }

        .h-screen {
            height: 100vh;
        }

        .max-h-\[40px\] {
            max-height: 40px;
        }

        .min-h-screen {
            min-height: 100vh;
        }

        .w-1\/3 {
            width: 33.333333%;
        }

        .w-1\/4 {
            width: 25%;
        }

        .w-2 {
            width: 0.5rem;
        }

        .w-2\.5 {
            width: 0.625rem;
        }

        .w-\[1px\] {
            width: 1px;
        }

        .w-\[80\%\] {
            width: 80%;
        }

        .w-fit {
            width: -moz-fit-content;
            width: fit-content;
        }

        .w-full {
            width: 100%;
        }

        .w-screen {
            width: 100vw;
        }

        .max-w-\[1000px\] {
            max-width: 1000px;
        }

        .max-w-\[1200px\] {
            max-width: 1200px;
        }

        .max-w-\[1400px\] {
            max-width: 1400px;
        }

        .max-w-\[500px\] {
            max-width: 500px;
        }

        .max-w-\[800px\] {
            max-width: 800px;
        }

        .flex-1 {
            flex: 1 1 0%;
        }

        .-translate-x-1\/2 {
            --tw-translate-x: -50%;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
        }

        .-translate-x-4 {
            --tw-translate-x: -1rem;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
        }

        .-translate-y-4 {
            --tw-translate-y: -1rem;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
        }

        .translate-x-1\/2 {
            --tw-translate-x: 50%;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }

        .flex-col {
            flex-direction: column;
        }

        .flex-wrap {
            flex-wrap: wrap;
        }

        .place-items-center {
            place-items: center;
        }

        .items-center {
            align-items: center;
        }

        .justify-center {
            justify-content: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .gap-10 {
            gap: 2.5rem;
        }

        .gap-14 {
            gap: 3.5rem;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .gap-3 {
            gap: 0.75rem;
        }

        .gap-4 {
            gap: 1rem;
        }

        .gap-8 {
            gap: 2rem;
        }

        .overflow-hidden {
            overflow: hidden;
        }

        .rounded-full {
            border-radius: 9999px;
        }

        .rounded-md {
            border-radius: 0.375rem;
        }

        .rounded-b-lg {
            border-bottom-right-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
        }

        .rounded-t-xl {
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
        }

        .border {
            border-width: 1px;
        }

        .border-\[1\.5px\] {
            border-width: 1.5px;
        }

        .border-b {
            border-bottom-width: 1px;
        }

        .border-solid {
            border-style: solid;
        }

        .border-none {
            border-style: none;
        }

        .border-green-300 {
            --tw-border-opacity: 1;
            border-color: rgb(134 239 172 / var(--tw-border-opacity));
        }

        .border-indigo-400 {
            --tw-border-opacity: 1;
            border-color: rgb(129 140 248 / var(--tw-border-opacity));
        }

        .bg-\[\#181b34\] {
            --tw-bg-opacity: 1;
            background-color: rgb(24 27 52 / var(--tw-bg-opacity));
        }

        .bg-indigo-300 {
            --tw-bg-opacity: 1;
            background-color: rgb(165 180 252 / var(--tw-bg-opacity));
        }

        .bg-indigo-50 {
            --tw-bg-opacity: 1;
            background-color: rgb(238 242 255 / var(--tw-bg-opacity));
        }

        .bg-slate-950 {
            --tw-bg-opacity: 1;
            background-color: rgb(2 6 23 / var(--tw-bg-opacity));
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity));
        }

        .bg-gradient-to-tr {
            background-image: linear-gradient(to top right, var(--tw-gradient-stops));
        }

        .from-blue-100 {
            --tw-gradient-from: #dbeafe var(--tw-gradient-from-position);
            --tw-gradient-to: rgb(219 234 254 / 0) var(--tw-gradient-to-position);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
        }

        .to-cyan-100 {
            --tw-gradient-to: #cffafe var(--tw-gradient-to-position);
        }

        .p-1 {
            padding: 0.25rem;
        }

        .p-1\.5 {
            padding: 0.375rem;
        }

        .p-2 {
            padding: 0.5rem;
        }

        .p-4 {
            padding: 1rem;
        }

        .p-5 {
            padding: 1.25rem;
        }

        .px-3 {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .px-8 {
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .py-0 {
            padding-top: 0px;
            padding-bottom: 0px;
        }

        .py-0\.5 {
            padding-top: 0.125rem;
            padding-bottom: 0.125rem;
        }

        .py-14 {
            padding-top: 3.5rem;
            padding-bottom: 3.5rem;
        }

        .py-16 {
            padding-top: 4rem;
            padding-bottom: 4rem;
        }

        .py-20 {
            padding-top: 5rem;
            padding-bottom: 5rem;
        }

        .py-6 {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .pb-10 {
            padding-bottom: 2.5rem;
        }

        .pb-2 {
            padding-bottom: 0.5rem;
        }

        .pl-4 {
            padding-left: 1rem;
        }

        .pr-10 {
            padding-right: 2.5rem;
        }

        .pr-2 {
            padding-right: 0.5rem;
        }

        .pt-10 {
            padding-top: 2.5rem;
        }

        .pt-2 {
            padding-top: 0.5rem;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-2xl {
            font-size: 1.5rem;
            line-height: 2rem;
        }

        .text-3xl {
            font-size: 1.875rem;
            line-height: 2.25rem;
        }

        .text-4xl {
            font-size: 2.25rem;
            line-height: 2.5rem;
        }

        .text-5xl {
            font-size: 3rem;
            line-height: 1;
        }

        .text-base {
            font-size: 1rem;
            line-height: 1.5rem;
        }

        .text-lg {
            font-size: 1.125rem;
            line-height: 1.75rem;
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem;
        }

        .text-xs {
            font-size: 0.75rem;
            line-height: 1rem;
        }

        .font-bold {
            font-weight: 700;
        }

        .font-medium {
            font-weight: 500;
        }

        .font-semibold {
            font-weight: 600;
        }

        .italic {
            font-style: italic;
        }

        .text-amber-400 {
            --tw-text-opacity: 1;
            color: rgb(251 191 36 / var(--tw-text-opacity));
        }

        .text-green-400 {
            --tw-text-opacity: 1;
            color: rgb(74 222 128 / var(--tw-text-opacity));
        }

        .text-indigo-400 {
            --tw-text-opacity: 1;
            color: rgb(129 140 248 / var(--tw-text-opacity));
        }

        .text-slate-600 {
            --tw-text-opacity: 1;
            color: rgb(71 85 105 / var(--tw-text-opacity));
        }

        .text-slate-900 {
            --tw-text-opacity: 1;
            color: rgb(15 23 42 / var(--tw-text-opacity));
        }

        .text-white {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity));
        }

        .line-through {
            text-decoration-line: line-through;
        }

        .opacity-0 {
            opacity: 0;
        }

        .opacity-10 {
            opacity: 0.1;
        }

        .opacity-60 {
            opacity: 0.6;
        }

        .outline-none {
            outline: 2px solid transparent;
            outline-offset: 2px;
        }

        .duration-200 {
            transition-duration: 200ms;
        }

        html {
            scroll-behavior: smooth;
        }

        * {
            font-family: "Open Sans", sans-serif;
        }

        h1,
        h2,
        h3,
        .poppins {
            font-family: "Poppins", sans-serif;
        }

        span {
            font-family: inherit;
            font-weight: inherit;
        }

        .bgGrid {
            background-size: 40px 40px;
            background-image: linear-gradient(to right, grey 1px, transparent 1px),
                linear-gradient(to bottom, grey 1px, transparent 1px);
        }

        button,
        .button {
            border-radius: 8px;
            border: 1px solid transparent;
            padding: 0.6em 1.2em;
            font-size: 1em;
            font-weight: 500;
            font-family: inherit;
            background-color: white;
            cursor: pointer;
            transition: border-color 0.2s;
        }

        button:hover {
            border-color: #646cff;
        }

        button:focus,
        border:focus-visible {
            outline: 4px auto -webkit-focus-ring-color;
        }

        .specialButton {
            border-color: #646cff;
        }

        .specialButtonDark {
            background: #646cff;
            color: white;
        }

        .specialButton:hover {
            border-color: blue;
        }

        .dropShadow {
            filter: drop-shadow(-10.8923px 14.523px 35.0973px rgba(29, 140, 242, 0.2));
        }

        .fadeIn {
            animation: fadeIn 500ms ease-in forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .after\:absolute::after {
            content: var(--tw-content);
            position: absolute;
        }

        .after\:left-0::after {
            content: var(--tw-content);
            left: 0px;
        }

        .after\:top-full::after {
            content: var(--tw-content);
            top: 100%;
        }

        .after\:mt-1::after {
            content: var(--tw-content);
            margin-top: 0.25rem;
        }

        .after\:h-1::after {
            content: var(--tw-content);
            height: 0.25rem;
        }

        .after\:h-1\.5::after {
            content: var(--tw-content);
            height: 0.375rem;
        }

        .after\:w-1\/5::after {
            content: var(--tw-content);
            width: 20%;
        }

        .after\:bg-slate-900::after {
            content: var(--tw-content);
            --tw-bg-opacity: 1;
            background-color: rgb(15 23 42 / var(--tw-bg-opacity));
        }

        .hover\:text-indigo-400:hover {
            --tw-text-opacity: 1;
            color: rgb(129 140 248 / var(--tw-text-opacity));
        }

        .group:hover .group-hover\:pl-2 {
            padding-left: 0.5rem;
        }

        @media (min-width: 640px) {

            .sm\:h-10 {
                height: 2.5rem;
            }

            .sm\:w-3 {
                width: 0.75rem;
            }

            .sm\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .sm\:gap-10 {
                gap: 2.5rem;
            }

            .sm\:gap-14 {
                gap: 3.5rem;
            }

            .sm\:py-20 {
                padding-top: 5rem;
                padding-bottom: 5rem;
            }

            .sm\:text-2xl {
                font-size: 1.5rem;
                line-height: 2rem;
            }

            .sm\:text-3xl {
                font-size: 1.875rem;
                line-height: 2.25rem;
            }

            .sm\:text-5xl {
                font-size: 3rem;
                line-height: 1;
            }

            .sm\:text-6xl {
                font-size: 3.75rem;
                line-height: 1;
            }

            .sm\:text-base {
                font-size: 1rem;
                line-height: 1.5rem;
            }

            .sm\:text-lg {
                font-size: 1.125rem;
                line-height: 1.75rem;
            }

            .sm\:text-sm {
                font-size: 0.875rem;
                line-height: 1.25rem;
            }

            .sm\:text-xl {
                font-size: 1.25rem;
                line-height: 1.75rem;
            }
        }

        @media (min-width: 768px) {

            .md\:-bottom-1\/4 {
                bottom: -25%;
            }

            .md\:order-2 {
                order: 2;
            }

            .md\:col-span-2 {
                grid-column: span 2 / span 2;
            }

            .md\:flex {
                display: flex;
            }

            .md\:grid {
                display: grid;
            }

            .md\:hidden {
                display: none;
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .md\:grid-cols-5 {
                grid-template-columns: repeat(5, minmax(0, 1fr));
            }

            .md\:flex-row {
                flex-direction: row;
            }

            .md\:gap-10 {
                gap: 2.5rem;
            }

            .md\:gap-14 {
                gap: 3.5rem;
            }

            .md\:gap-16 {
                gap: 4rem;
            }

            .md\:gap-24 {
                gap: 6rem;
            }

            .md\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem;
            }

            .md\:py-20 {
                padding-top: 5rem;
                padding-bottom: 5rem;
            }

            .md\:py-24 {
                padding-top: 6rem;
                padding-bottom: 6rem;
            }

            .md\:pb-14 {
                padding-bottom: 3.5rem;
            }

            .md\:text-2xl {
                font-size: 1.5rem;
                line-height: 2rem;
            }

            .md\:text-3xl {
                font-size: 1.875rem;
                line-height: 2.25rem;
            }

            .md\:text-4xl {
                font-size: 2.25rem;
                line-height: 2.5rem;
            }

            .md\:text-6xl {
                font-size: 3.75rem;
                line-height: 1;
            }

            .md\:text-7xl {
                font-size: 4.5rem;
                line-height: 1;
            }

            .md\:text-xl {
                font-size: 1.25rem;
                line-height: 1.75rem;
            }
        }

        @media (min-width: 1024px) {

            .lg\:gap-20 {
                gap: 5rem;
            }

            .lg\:gap-6 {
                gap: 1.5rem;
            }

            .lg\:text-8xl {
                font-size: 6rem;
                line-height: 1;
            }
        }
    </style>

</head>

<body data-sveltekit-preload-data="hover"
    class="relative bg-gradient-to-tr from-indigo-900 to-black min-h-screen text-gray-100 text-sm sm:text-base flex flex-col">
    <div class="inset-0 opacity-10 absolute z-[-1] bgGrid"></div>
    <div style="display: contents">
        <main class="flex flex-col">
            @yield('content')
        </main><!--<+page>-->
        <footer class="py-16 sm:py-20 md:py-24 px-4 md:px-8">
            <div class="max-w-[1200px] mx-auto w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-8 text-base">
                <div class="flex flex-col gap-4 md:col-span-2">
                    <h1 class="font-semibold">Gimmie <span class="text-indigo-400"
                            data-svelte-h="svelte-11m9ge5">Gym</span></h1>
                    <p data-svelte-h="svelte-5ipm2m">2023 GIMMIE GYM LTD. All rights reserved.</p>
                </div>
                <div class="flex flex-col gap-4">
                    <p class="font-bold poppins text-base sm:text-lg" data-svelte-h="svelte-1iqyksc">Support</p> <a
                        href="" target="_blank" class="cursor-pointer hover:text-indigo-400 duration-200"
                        data-svelte-h="svelte-rhjjr2">Contact Us</a>
                </div>
                <div class="flex flex-col gap-4">
                    <p class="font-bold poppins text-base sm:text-lg" data-svelte-h="svelte-1f54018">Research</p> <a
                        href="" target="_blank" class="cursor-pointer hover:text-indigo-400 duration-200"
                        data-svelte-h="svelte-o3xkgw">Read Science</a>
                </div>
                <div class="flex flex-col gap-4">
                    <p class="font-bold poppins text-base sm:text-lg" data-svelte-h="svelte-qe7on4">Follow us</p> <a
                        href="" target="_blank" class="cursor-pointer hover:text-indigo-400 duration-200"><i
                            class="fa-brands fa-instagram pr-2"></i>Instagram</a> <a href="" target="_blank"
                        class="cursor-pointer hover:text-indigo-400 duration-200"><i
                            class="fa-brands fa-youtube pr-2"></i>Youtube</a> <a href="" target="_blank"
                        class="cursor-pointer hover:text-indigo-400 duration-200"><i
                            class="fa-brands fa-facebook pr-2"></i>Facebook</a>
                </div>
            </div>
        </footer><!--<Footer>--><!--<+layout>-->
    </div>
</body>

</html>