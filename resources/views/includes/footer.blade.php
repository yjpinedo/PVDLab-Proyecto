<footer class="m-grid__item	m-footer">
    <div class="m-container m-container--fluid m-container--full-height m-page__container">
        <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
            <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                <span class="m-footer__copyright">
                    © {{ date('Y') }} {{ config('app.name') }} by <a href="http://orioncol.com" class="m-link" rel="noreferrer" target="_blank">{{ config('app.company') }}</a>.
                    <span> @lang('All rights reserved.')</span>
                </span>
            </div>
            <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                <span class="m-footer__copyright"> @version </span>
            </div>
        </div>
    </div>
</footer>
