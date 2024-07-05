<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Exousia Navi</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link
    rel="stylesheet"
    data-purpose="Layout StyleSheet"
    title="Web Awesome"
    href="/css/app-wa-462d1fe84b879d730fe2180b0e0354e0.css?vsn=d"
  />
  <link
    rel="stylesheet"
    href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css"
  />
  <link
    rel="stylesheet"
    href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css"
  />
  <link
    rel="stylesheet"
    href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css"
  />
  <link
    rel="stylesheet"
    href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css"
  />
  <link
    rel="stylesheet"
    href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css"
  />
    <style>
        .loader {
            background: linear-gradient(#0ebb52, #039840, #037937);
            animation: animate 1.5s linear infinite;
        }

        @keyframes animate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .loader span {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: linear-gradient(#0ebb52, #039840, #037937);
        }

        .loader span:nth-child(1) {
            filter: blur(5px);
        }

        .loader span:nth-child(2) {
            filter: blur(10px);
        }

        .loader span:nth-child(3) {
            filter: blur(25px);
        }

        .loader span:nth-child(4) {
            filter: blur(50px);
        }

        .loader:after {
            content: '';
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            background: #d0fbd9;
            border-radius: 50%;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#011e0f] overflow-hidden">
    <!-- ========== HEADER ========== -->
    <header
        class="flex flex-wrap sm:justify-start sm:flex-nowrap z-50 w-full bg-[#054f26] border-b border-[#a6f4ba] text-sm py-2 sm:py-0">
        <nav class="relative max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8 text-[#ecfdf0]"
            aria-label="Global">
            <div class="flex items-center justify-between">
                <a class="flex-none text-xl font-semibold dark:text-white" href="#" aria-label="Brand">Exousia</a>
                <div class="sm:hidden">
                    <button type="button"
                        class="hs-collapse-toggle size-9 flex justify-center items-center text-sm font-semibold rounded-lg border border-gray-200 hover:text-[#011e0f] disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-neutral-700 dark:hover:bg-neutral-700"
                        data-hs-collapse="#navbar-collapse-with-animation"
                        aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
                        <svg class="hs-collapse-open:hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                        <svg class="hs-collapse-open:block hidden flex-shrink-0 size-4"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div id="navbar-collapse-with-animation"
                class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
                <div class="flex flex-col sm:flex-row sm:items-center py-2 md:py-0 sm:ps-7">
                    <a class="py-3 ps-px sm:px-3 sm:py-6 font-medium dark:text-blue-500" href="#"
                        aria-current="page">Landing</a>
                    


                    <div class="flex items-center gap-x-2 py-2 sm:py-0 sm:ms-auto">
                        <a class="flex items-center gap-x-2 font-medium hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-500"
                            href="#">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            Log in
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- ========== END HEADER ========== -->
    <div>
        @yield('contents')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @yield('scripts')
</body>

</html>
