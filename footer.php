    <script>
        (function () {
            var storedTheme = localStorage.getItem('theme');
            var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            var theme = storedTheme || (prefersDark ? 'dark' : 'light');
            var logo = document.querySelector('.logo');

            document.documentElement.classList.toggle('dark', theme === 'dark');
            document.documentElement.setAttribute('data-theme', theme);

            if (logo) {
                logo.src = theme === 'dark' ? logo.dataset.logoDark : logo.dataset.logoLight;
            }
        })();
    </script>
    
    <script>
        (function () {
            var root = document.documentElement;
            var toggle = document.querySelector('.theme-toggle');
            var logo = document.querySelector('.logo');
            var mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

            if (!toggle) {
                return;
            }

            function applyTheme(theme, persist) {
                root.classList.toggle('dark', theme === 'dark');
                root.setAttribute('data-theme', theme);
                toggle.setAttribute('aria-pressed', String(theme === 'dark'));

                if (logo) {
                    logo.src = theme === 'dark' ? logo.dataset.logoDark : logo.dataset.logoLight;
                }

                if (persist) {
                    localStorage.setItem('theme', theme);
                }
            }

            function getPreferredTheme() {
                var storedTheme = localStorage.getItem('theme');

                if (storedTheme === 'dark' || storedTheme === 'light') {
                    return storedTheme;
                }

                return mediaQuery.matches ? 'dark' : 'light';
            }

            applyTheme(getPreferredTheme(), false);

            toggle.addEventListener('click', function () {
                var nextTheme = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
                applyTheme(nextTheme, true);
            });

            mediaQuery.addEventListener('change', function (event) {
                if (localStorage.getItem('theme')) {
                    return;
                }

                applyTheme(event.matches ? 'dark' : 'light', false);
            });
        })();
    </script>
</body>
