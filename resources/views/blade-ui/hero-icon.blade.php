<x-app-layout>
    <div x-data="{
    type: 'o',
    view(text){
        swal.fire({
            icon: 'info',
            input: 'text',
            inputValue: `<${text} />`,
            showCloseButton:true,
            showCancelButton:true,
            confirmButtonText:'Copy'
        }).then((result)=>{
            if(result.isConfirmed)
                this.copy(text)
        })
    },
    copy(text){
        navigator.clipboard.writeText(`<${text} />`)
            .then(() => {
                swal.fire({
                    icon: 'success',
                    title: 'Code copied to clipboard!',
                    timer: 1500,
                    toast: true,
                    position: 'bottom-left',
                    timerProgressBar: true,
                    showConfirmButton: false,
                })
            })
            .catch(err => {
                swal.fire({
                    icon: 'error',
                    title: err,
                    timer: 1500,
                    toast: true,
                    position: 'bottom-left',
                    timerProgressBar: true,
                    showConfirmButton: false,
                })
            });
    }
}">



        <div class="p-5 space-y-3 border rounded shadow">

            <div class="flex justify-end border-b">
                <button @click="type='o'"
                    :class="{'bg-green-500 text-white':type==='o','bg-white text-green-500':type!=='o'}"
                    class="px-5 py-4 text-xs font-semibold tracking-wider uppercase rounded-t">Type Outline</button>
                <button @click="type='s'"
                    :class="{'bg-green-500 text-white':type==='s','bg-white text-green-500':type!=='s'}"
                    class="px-5 py-4 text-xs font-semibold tracking-wider uppercase rounded-t">Type Solid</button>
            </div>

            <div x-show="type==='o'" class="grid grid-cols-12 gap-3 p-3 border rounded">
                <x-heroicon-o-academic-cap @click="view('x-heroicon-o-academic-cap')" class="w-full" />
                <x-heroicon-o-adjustments @click="view('x-heroicon-o-adjustments')" class="w-full" />
                <x-heroicon-o-annotation @click="view('x-heroicon-o-annotation')" class="w-full" />
                <x-heroicon-o-archive @click="view('x-heroicon-o-archive')" class="w-full" />
                <x-heroicon-o-arrow-circle-down @click="view('x-heroicon-o-arrow-circle-down')" class="w-full" />
                <x-heroicon-o-arrow-circle-left @click="view('x-heroicon-o-arrow-circle-left')" class="w-full" />
                <x-heroicon-o-arrow-circle-right @click="view('x-heroicon-o-arrow-circle-right')" class="w-full" />
                <x-heroicon-o-arrow-circle-up @click="view('x-heroicon-o-arrow-circle-up')" class="w-full" />
                <x-heroicon-o-arrow-down @click="view('x-heroicon-o-arrow-down')" class="w-full" />
                <x-heroicon-o-arrow-left @click="view('x-heroicon-o-arrow-left')" class="w-full" />
                <x-heroicon-o-arrow-narrow-down @click="view('x-heroicon-o-arrow-narrow-down')" class="w-full" />
                <x-heroicon-o-arrow-narrow-left @click="view('x-heroicon-o-arrow-narrow-left')" class="w-full" />
                <x-heroicon-o-arrow-narrow-right @click="view('x-heroicon-o-arrow-narrow-right')" class="w-full" />
                <x-heroicon-o-arrow-narrow-up @click="view('x-heroicon-o-arrow-narrow-up')" class="w-full" />
                <x-heroicon-o-arrow-right @click="view('x-heroicon-o-arrow-right')" class="w-full" />
                <x-heroicon-o-arrows-expand @click="view('x-heroicon-o-arrows-expand')" class="w-full" />
                <x-heroicon-o-at-symbol @click="view('x-heroicon-o-at-symbol')" class="w-full" />
                <x-heroicon-o-backspace @click="view('x-heroicon-o-backspace')" class="w-full" />
                <x-heroicon-o-ban @click="view('x-heroicon-o-ban')" class="w-full" />
                <x-heroicon-o-beaker @click="view('x-heroicon-o-beaker')" class="w-full" />
                <x-heroicon-o-bell @click="view('x-heroicon-o-bell')" class="w-full" />
                <x-heroicon-o-book-open @click="view('x-heroicon-o-book-open')" class="w-full" />
                <x-heroicon-o-bookmark-alt @click="view('x-heroicon-o-bookmark-alt')" class="w-full" />
                <x-heroicon-o-bookmark @click="view('x-heroicon-o-bookmark')" class="w-full" />
                <x-heroicon-o-briefcase @click="view('x-heroicon-o-briefcase')" class="w-full" />
                <x-heroicon-o-cake @click="view('x-heroicon-o-cake')" class="w-full" />
                <x-heroicon-o-calculator @click="view('x-heroicon-o-calculator')" class="w-full" />
                <x-heroicon-o-calendar @click="view('x-heroicon-o-calendar')" class="w-full" />
                <x-heroicon-o-camera @click="view('x-heroicon-o-camera')" class="w-full" />
                <x-heroicon-o-cash @click="view('x-heroicon-o-cash')" class="w-full" />
                <x-heroicon-o-chart-bar @click="view('x-heroicon-o-chart-bar')" class="w-full" />
                <x-heroicon-o-chart-pie @click="view('x-heroicon-o-chart-pie')" class="w-full" />
                <x-heroicon-o-chart-square-bar @click="view('x-heroicon-o-chart-square-bar')" class="w-full" />
                <x-heroicon-o-chat-alt-2 @click="view('x-heroicon-o-chat-alt-2')" class="w-full" />
                <x-heroicon-o-chat-alt @click="view('x-heroicon-o-chat-alt')" class="w-full" />
                <x-heroicon-o-chat @click="view('x-heroicon-o-chat')" class="w-full" />
                <x-heroicon-o-check-circle @click="view('x-heroicon-o-check-circle')" class="w-full" />
                <x-heroicon-o-check @click="view('x-heroicon-o-check')" class="w-full" />
                <x-heroicon-o-chevron-double-down @click="view('x-heroicon-o-chevron-double-down')" class="w-full" />
                <x-heroicon-o-chevron-double-left @click="view('x-heroicon-o-chevron-double-left')" class="w-full" />
                <x-heroicon-o-chevron-double-right @click="view('x-heroicon-o-chevron-double-right')" class="w-full" />
                <x-heroicon-o-chevron-double-up @click="view('x-heroicon-o-chevron-double-up')" class="w-full" />
                <x-heroicon-o-chevron-down @click="view('x-heroicon-o-chevron-down')" class="w-full" />
                <x-heroicon-o-chevron-left @click="view('x-heroicon-o-chevron-left')" class="w-full" />
                <x-heroicon-o-chevron-right @click="view('x-heroicon-o-chevron-right')" class="w-full" />
                <x-heroicon-o-chevron-up @click="view('x-heroicon-o-chevron-up')" class="w-full" />
                <x-heroicon-o-chip @click="view('x-heroicon-o-chip')" class="w-full" />
                <x-heroicon-o-clipboard-check @click="view('x-heroicon-o-clipboard-check')" class="w-full" />
                <x-heroicon-o-clipboard-copy @click="view('x-heroicon-o-clipboard-copy')" class="w-full" />
                <x-heroicon-o-clipboard-list @click="view('x-heroicon-o-clipboard-list')" class="w-full" />
                <x-heroicon-o-clipboard @click="view('x-heroicon-o-clipboard')" class="w-full" />
                <x-heroicon-o-clock @click="view('x-heroicon-o-clock')" class="w-full" />
                <x-heroicon-o-cloud-download @click="view('x-heroicon-o-cloud-download')" class="w-full" />
                <x-heroicon-o-cloud-upload @click="view('x-heroicon-o-cloud-upload')" class="w-full" />
                <x-heroicon-o-cloud @click="view('x-heroicon-o-cloud')" class="w-full" />
                <x-heroicon-o-code @click="view('x-heroicon-o-code')" class="w-full" />
                <x-heroicon-o-cog @click="view('x-heroicon-o-cog')" class="w-full" />
                <x-heroicon-o-collection @click="view('x-heroicon-o-collection')" class="w-full" />
                <x-heroicon-o-color-swatch @click="view('x-heroicon-o-color-swatch')" class="w-full" />
                <x-heroicon-o-credit-card @click="view('x-heroicon-o-credit-card')" class="w-full" />
                <x-heroicon-o-cube-transparent @click="view('x-heroicon-o-cube-transparent')" class="w-full" />
                <x-heroicon-o-cube @click="view('x-heroicon-o-cube')" class="w-full" />
                <x-heroicon-o-currency-bangladeshi @click="view('x-heroicon-o-currency-bangladeshi')" class="w-full" />
                <x-heroicon-o-currency-dollar @click="view('x-heroicon-o-currency-dollar')" class="w-full" />
                <x-heroicon-o-currency-euro @click="view('x-heroicon-o-currency-euro')" class="w-full" />
                <x-heroicon-o-currency-pound @click="view('x-heroicon-o-currency-pound')" class="w-full" />
                <x-heroicon-o-currency-rupee @click="view('x-heroicon-o-currency-rupee')" class="w-full" />
                <x-heroicon-o-currency-yen @click="view('x-heroicon-o-currency-yen')" class="w-full" />
                <x-heroicon-o-cursor-click @click="view('x-heroicon-o-cursor-click')" class="w-full" />
                <x-heroicon-o-database @click="view('x-heroicon-o-database')" class="w-full" />
                <x-heroicon-o-desktop-computer @click="view('x-heroicon-o-desktop-computer')" class="w-full" />
                <x-heroicon-o-device-mobile @click="view('x-heroicon-o-device-mobile')" class="w-full" />
                <x-heroicon-o-device-tablet @click="view('x-heroicon-o-device-tablet')" class="w-full" />
                <x-heroicon-o-document-add @click="view('x-heroicon-o-document-add')" class="w-full" />
                <x-heroicon-o-document-download @click="view('x-heroicon-o-document-download')" class="w-full" />
                <x-heroicon-o-document-duplicate @click="view('x-heroicon-o-document-duplicate')" class="w-full" />
                <x-heroicon-o-document-remove @click="view('x-heroicon-o-document-remove')" class="w-full" />
                <x-heroicon-o-document-report @click="view('x-heroicon-o-document-report')" class="w-full" />
                <x-heroicon-o-document-search @click="view('x-heroicon-o-document-search')" class="w-full" />
                <x-heroicon-o-document-text @click="view('x-heroicon-o-document-text')" class="w-full" />
                <x-heroicon-o-document @click="view('x-heroicon-o-document')" class="w-full" />
                <x-heroicon-o-dots-circle-horizontal @click="view('x-heroicon-o-dots-circle-horizontal')"
                    class="w-full" />
                <x-heroicon-o-dots-horizontal @click="view('x-heroicon-o-dots-horizontal')" class="w-full" />
                <x-heroicon-o-dots-vertical @click="view('x-heroicon-o-dots-vertical')" class="w-full" />
                <x-heroicon-o-download @click="view('x-heroicon-o-download')" class="w-full" />
                <x-heroicon-o-duplicate @click="view('x-heroicon-o-duplicate')" class="w-full" />
                <x-heroicon-o-emoji-happy @click="view('x-heroicon-o-emoji-happy')" class="w-full" />
                <x-heroicon-o-emoji-sad @click="view('x-heroicon-o-emoji-sad')" class="w-full" />
                <x-heroicon-o-exclamation-circle @click="view('x-heroicon-o-exclamation-circle')" class="w-full" />
                <x-heroicon-o-exclamation @click="view('x-heroicon-o-exclamation')" class="w-full" />
                <x-heroicon-o-external-link @click="view('x-heroicon-o-external-link')" class="w-full" />
                <x-heroicon-o-eye-off @click="view('x-heroicon-o-eye-off')" class="w-full" />
                <x-heroicon-o-eye @click="view('x-heroicon-o-eye')" class="w-full" />
                <x-heroicon-o-fast-forward @click="view('x-heroicon-o-fast-forward')" class="w-full" />
                <x-heroicon-o-film @click="view('x-heroicon-o-film')" class="w-full" />
                <x-heroicon-o-filter @click="view('x-heroicon-o-filter')" class="w-full" />
                <x-heroicon-o-finger-print @click="view('x-heroicon-o-finger-print')" class="w-full" />
                <x-heroicon-o-fire @click="view('x-heroicon-o-fire')" class="w-full" />
                <x-heroicon-o-flag @click="view('x-heroicon-o-flag')" class="w-full" />
                <x-heroicon-o-folder-add @click="view('x-heroicon-o-folder-add')" class="w-full" />
                <x-heroicon-o-folder-download @click="view('x-heroicon-o-folder-download')" class="w-full" />
                <x-heroicon-o-folder-open @click="view('x-heroicon-o-folder-open')" class="w-full" />
                <x-heroicon-o-folder @click="view('x-heroicon-o-folder')" class="w-full" />
                <x-heroicon-o-gift @click="view('x-heroicon-o-gift')" class="w-full" />
                <x-heroicon-o-globe-alt @click="view('x-heroicon-o-globe-alt')" class="w-full" />
                <x-heroicon-o-globe @click="view('x-heroicon-o-globe')" class="w-full" />
                <x-heroicon-o-hand @click="view('x-heroicon-o-hand')" class="w-full" />
                <x-heroicon-o-hashtag @click="view('x-heroicon-o-hashtag')" class="w-full" />
                <x-heroicon-o-heart @click="view('x-heroicon-o-heart')" class="w-full" />
                <x-heroicon-o-home @click="view('x-heroicon-o-home')" class="w-full" />
                <x-heroicon-o-identification @click="view('x-heroicon-o-identification')" class="w-full" />
                <x-heroicon-o-inbox-in @click="view('x-heroicon-o-inbox-in')" class="w-full" />
                <x-heroicon-o-inbox @click="view('x-heroicon-o-inbox')" class="w-full" />
                <x-heroicon-o-information-circle @click="view('x-heroicon-o-information-circle')" class="w-full" />
                <x-heroicon-o-key @click="view('x-heroicon-o-key')" class="w-full" />
                <x-heroicon-o-library @click="view('x-heroicon-o-library')" class="w-full" />
                <x-heroicon-o-light-bulb @click="view('x-heroicon-o-light-bulb')" class="w-full" />
                <x-heroicon-o-lightning-bolt @click="view('x-heroicon-o-lightning-bolt')" class="w-full" />
                <x-heroicon-o-link @click="view('x-heroicon-o-link')" class="w-full" />
                <x-heroicon-o-location-marker @click="view('x-heroicon-o-location-marker')" class="w-full" />
                <x-heroicon-o-lock-closed @click="view('x-heroicon-o-lock-closed')" class="w-full" />
                <x-heroicon-o-lock-open @click="view('x-heroicon-o-lock-open')" class="w-full" />
                <x-heroicon-o-login @click="view('x-heroicon-o-login')" class="w-full" />
                <x-heroicon-o-logout @click="view('x-heroicon-o-logout')" class="w-full" />
                <x-heroicon-o-mail-open @click="view('x-heroicon-o-mail-open')" class="w-full" />
                <x-heroicon-o-mail @click="view('x-heroicon-o-mail')" class="w-full" />
                <x-heroicon-o-map @click="view('x-heroicon-o-map')" class="w-full" />
                <x-heroicon-o-menu-alt-1 @click="view('x-heroicon-o-menu-alt-1')" class="w-full" />
                <x-heroicon-o-menu-alt-2 @click="view('x-heroicon-o-menu-alt-2')" class="w-full" />
                <x-heroicon-o-menu-alt-3 @click="view('x-heroicon-o-menu-alt-3')" class="w-full" />
                <x-heroicon-o-menu-alt-4 @click="view('x-heroicon-o-menu-alt-4')" class="w-full" />
                <x-heroicon-o-menu @click="view('x-heroicon-o-menu')" class="w-full" />
                <x-heroicon-o-microphone @click="view('x-heroicon-o-microphone')" class="w-full" />
                <x-heroicon-o-minus-circle @click="view('x-heroicon-o-minus-circle')" class="w-full" />
                <x-heroicon-o-minus-sm @click="view('x-heroicon-o-minus-sm')" class="w-full" />
                <x-heroicon-o-minus @click="view('x-heroicon-o-minus')" class="w-full" />
                <x-heroicon-o-moon @click="view('x-heroicon-o-moon')" class="w-full" />
                <x-heroicon-o-music-note @click="view('x-heroicon-o-music-note')" class="w-full" />
                <x-heroicon-o-newspaper @click="view('x-heroicon-o-newspaper')" class="w-full" />
                <x-heroicon-o-office-building @click="view('x-heroicon-o-office-building')" class="w-full" />
                <x-heroicon-o-paper-airplane @click="view('x-heroicon-o-paper-airplane')" class="w-full" />
                <x-heroicon-o-paper-clip @click="view('x-heroicon-o-paper-clip')" class="w-full" />
                <x-heroicon-o-pause @click="view('x-heroicon-o-pause')" class="w-full" />
                <x-heroicon-o-pencil-alt @click="view('x-heroicon-o-pencil-alt')" class="w-full" />
                <x-heroicon-o-pencil @click="view('x-heroicon-o-pencil')" class="w-full" />
                <x-heroicon-o-phone-incoming @click="view('x-heroicon-o-phone-incoming')" class="w-full" />
                <x-heroicon-o-phone-missed-call @click="view('x-heroicon-o-phone-missed-call')" class="w-full" />
                <x-heroicon-o-phone-outgoing @click="view('x-heroicon-o-phone-outgoing')" class="w-full" />
                <x-heroicon-o-phone @click="view('x-heroicon-o-phone')" class="w-full" />
                <x-heroicon-o-photograph @click="view('x-heroicon-o-photograph')" class="w-full" />
                <x-heroicon-o-play @click="view('x-heroicon-o-play')" class="w-full" />
                <x-heroicon-o-plus-circle @click="view('x-heroicon-o-plus-circle')" class="w-full" />
                <x-heroicon-o-plus-sm @click="view('x-heroicon-o-plus-sm')" class="w-full" />
                <x-heroicon-o-plus @click="view('x-heroicon-o-plus')" class="w-full" />
                <x-heroicon-o-presentation-chart-bar @click="view('x-heroicon-o-presentation-chart-bar')"
                    class="w-full" />
                <x-heroicon-o-presentation-chart-line @click="view('x-heroicon-o-presentation-chart-line')"
                    class="w-full" />
                <x-heroicon-o-printer @click="view('x-heroicon-o-printer')" class="w-full" />
                <x-heroicon-o-puzzle @click="view('x-heroicon-o-puzzle')" class="w-full" />
                <x-heroicon-o-qrcode @click="view('x-heroicon-o-qrcode')" class="w-full" />
                <x-heroicon-o-question-mark-circle @click="view('x-heroicon-o-question-mark-circle')" class="w-full" />
                <x-heroicon-o-receipt-refund @click="view('x-heroicon-o-receipt-refund')" class="w-full" />
                <x-heroicon-o-receipt-tax @click="view('x-heroicon-o-receipt-tax')" class="w-full" />
                <x-heroicon-o-refresh @click="view('x-heroicon-o-refresh')" class="w-full" />
                <x-heroicon-o-reply @click="view('x-heroicon-o-reply')" class="w-full" />
                <x-heroicon-o-rewind @click="view('x-heroicon-o-rewind')" class="w-full" />
                <x-heroicon-o-rss @click="view('x-heroicon-o-rss')" class="w-full" />
                <x-heroicon-o-save-as @click="view('x-heroicon-o-save-as')" class="w-full" />
                <x-heroicon-o-save @click="view('x-heroicon-o-save')" class="w-full" />
                <x-heroicon-o-scale @click="view('x-heroicon-o-scale')" class="w-full" />
                <x-heroicon-o-scissors @click="view('x-heroicon-o-scissors')" class="w-full" />
                <x-heroicon-o-search-circle @click="view('x-heroicon-o-search-circle')" class="w-full" />
                <x-heroicon-o-search @click="view('x-heroicon-o-search')" class="w-full" />
                <x-heroicon-o-selector @click="view('x-heroicon-o-selector')" class="w-full" />
                <x-heroicon-o-server @click="view('x-heroicon-o-server')" class="w-full" />
                <x-heroicon-o-share @click="view('x-heroicon-o-share')" class="w-full" />
                <x-heroicon-o-shield-exclamation @click="view('x-heroicon-o-shield-exclamation')" class="w-full" />
                <x-heroicon-o-shopping-bag @click="view('x-heroicon-o-shopping-bag')" class="w-full" />
                <x-heroicon-o-shopping-cart @click="view('x-heroicon-o-shopping-cart')" class="w-full" />
                <x-heroicon-o-sort-ascending @click="view('x-heroicon-o-sort-ascending')" class="w-full" />
                <x-heroicon-o-sort-descending @click="view('x-heroicon-o-sort-descending')" class="w-full" />
                <x-heroicon-o-sparkles @click="view('x-heroicon-o-sparkles')" class="w-full" />
                <x-heroicon-o-speakerphone @click="view('x-heroicon-o-speakerphone')" class="w-full" />
                <x-heroicon-o-star @click="view('x-heroicon-o-star')" class="w-full" />
                <x-heroicon-o-status-offline @click="view('x-heroicon-o-status-offline')" class="w-full" />
                <x-heroicon-o-status-online @click="view('x-heroicon-o-status-online')" class="w-full" />
                <x-heroicon-o-stop @click="view('x-heroicon-o-stop')" class="w-full" />
                <x-heroicon-o-sun @click="view('x-heroicon-o-sun')" class="w-full" />
                <x-heroicon-o-support @click="view('x-heroicon-o-support')" class="w-full" />
                <x-heroicon-o-switch-horizontal @click="view('x-heroicon-o-switch-horizontal')" class="w-full" />
                <x-heroicon-o-switch-vertical @click="view('x-heroicon-o-switch-vertical')" class="w-full" />
                <x-heroicon-o-table @click="view('x-heroicon-o-table')" class="w-full" />
                <x-heroicon-o-tag @click="view('x-heroicon-o-tag')" class="w-full" />
                <x-heroicon-o-template @click="view('x-heroicon-o-template')" class="w-full" />
                <x-heroicon-o-terminal @click="view('x-heroicon-o-terminal')" class="w-full" />
                <x-heroicon-o-thumb-down @click="view('x-heroicon-o-thumb-down')" class="w-full" />
                <x-heroicon-o-thumb-up @click="view('x-heroicon-o-thumb-up')" class="w-full" />
                <x-heroicon-o-ticket @click="view('x-heroicon-o-ticket')" class="w-full" />
                <x-heroicon-o-translate @click="view('x-heroicon-o-translate')" class="w-full" />
                <x-heroicon-o-trash @click="view('x-heroicon-o-trash')" class="w-full" />
                <x-heroicon-o-trending-down @click="view('x-heroicon-o-trending-down')" class="w-full" />
                <x-heroicon-o-trending-up @click="view('x-heroicon-o-trending-up')" class="w-full" />
                <x-heroicon-o-truck @click="view('x-heroicon-o-truck')" class="w-full" />
                <x-heroicon-o-upload @click="view('x-heroicon-o-upload')" class="w-full" />
                <x-heroicon-o-user-add @click="view('x-heroicon-o-user-add')" class="w-full" />
                <x-heroicon-o-user-circle @click="view('x-heroicon-o-user-circle')" class="w-full" />
                <x-heroicon-o-user-group @click="view('x-heroicon-o-user-group')" class="w-full" />
                <x-heroicon-o-user-remove @click="view('x-heroicon-o-user-remove')" class="w-full" />
                <x-heroicon-o-user @click="view('x-heroicon-o-user')" class="w-full" />
                <x-heroicon-o-users @click="view('x-heroicon-o-users')" class="w-full" />
                <x-heroicon-o-variable @click="view('x-heroicon-o-variable')" class="w-full" />
                <x-heroicon-o-video-camera @click="view('x-heroicon-o-video-camera')" class="w-full" />
                <x-heroicon-o-view-boards @click="view('x-heroicon-o-view-boards')" class="w-full" />
                <x-heroicon-o-view-grid-add @click="view('x-heroicon-o-view-grid-add')" class="w-full" />
                <x-heroicon-o-view-grid @click="view('x-heroicon-o-view-grid')" class="w-full" />
                <x-heroicon-o-view-list @click="view('x-heroicon-o-view-list')" class="w-full" />
                <x-heroicon-o-volume-off @click="view('x-heroicon-o-volume-off')" class="w-full" />
                <x-heroicon-o-volume-up @click="view('x-heroicon-o-volume-up')" class="w-full" />
                <x-heroicon-o-wifi @click="view('x-heroicon-o-wifi')" class="w-full" />
                <x-heroicon-o-x-circle @click="view('x-heroicon-o-x-circle')" class="w-full" />
                <x-heroicon-o-x @click="view('x-heroicon-o-x')" class="w-full" />
                <x-heroicon-o-zoom-in @click="view('x-heroicon-o-zoom-in')" class="w-full" />
                <x-heroicon-o-zoom-out @click="view('x-heroicon-o-zoom-out')" class="w-full" />

            </div>

            <div x-show="type==='s'" class="grid grid-cols-12 gap-3 p-3 border rounded">
                <x-heroicon-s-academic-cap @click="view('x-heroicon-s-academic-cap')" class="w-full" />
                <x-heroicon-s-adjustments @click="view('x-heroicon-s-adjustments')" class="w-full" />
                <x-heroicon-s-annotation @click="view('x-heroicon-s-annotation')" class="w-full" />
                <x-heroicon-s-archive @click="view('x-heroicon-s-archive')" class="w-full" />
                <x-heroicon-s-arrow-circle-down @click="view('x-heroicon-s-arrow-circle-down')" class="w-full" />
                <x-heroicon-s-arrow-circle-left @click="view('x-heroicon-s-arrow-circle-left')" class="w-full" />
                <x-heroicon-s-arrow-circle-right @click="view('x-heroicon-s-arrow-circle-right')" class="w-full" />
                <x-heroicon-s-arrow-circle-up @click="view('x-heroicon-s-arrow-circle-up')" class="w-full" />
                <x-heroicon-s-arrow-down @click="view('x-heroicon-s-arrow-down')" class="w-full" />
                <x-heroicon-s-arrow-left @click="view('x-heroicon-s-arrow-left')" class="w-full" />
                <x-heroicon-s-arrow-narrow-down @click="view('x-heroicon-s-arrow-narrow-down')" class="w-full" />
                <x-heroicon-s-arrow-narrow-left @click="view('x-heroicon-s-arrow-narrow-left')" class="w-full" />
                <x-heroicon-s-arrow-narrow-right @click="view('x-heroicon-s-arrow-narrow-right')" class="w-full" />
                <x-heroicon-s-arrow-narrow-up @click="view('x-heroicon-s-arrow-narrow-up')" class="w-full" />
                <x-heroicon-s-arrow-right @click="view('x-heroicon-s-arrow-right')" class="w-full" />
                <x-heroicon-s-arrows-expand @click="view('x-heroicon-s-arrows-expand')" class="w-full" />
                <x-heroicon-s-at-symbol @click="view('x-heroicon-s-at-symbol')" class="w-full" />
                <x-heroicon-s-backspace @click="view('x-heroicon-s-backspace')" class="w-full" />
                <x-heroicon-s-ban @click="view('x-heroicon-s-ban')" class="w-full" />
                <x-heroicon-s-beaker @click="view('x-heroicon-s-beaker')" class="w-full" />
                <x-heroicon-s-bell @click="view('x-heroicon-s-bell')" class="w-full" />
                <x-heroicon-s-book-open @click="view('x-heroicon-s-book-open')" class="w-full" />
                <x-heroicon-s-bookmark-alt @click="view('x-heroicon-s-bookmark-alt')" class="w-full" />
                <x-heroicon-s-bookmark @click="view('x-heroicon-s-bookmark')" class="w-full" />
                <x-heroicon-s-briefcase @click="view('x-heroicon-s-briefcase')" class="w-full" />
                <x-heroicon-s-cake @click="view('x-heroicon-s-cake')" class="w-full" />
                <x-heroicon-s-calculator @click="view('x-heroicon-s-calculator')" class="w-full" />
                <x-heroicon-s-calendar @click="view('x-heroicon-s-calendar')" class="w-full" />
                <x-heroicon-s-camera @click="view('x-heroicon-s-camera')" class="w-full" />
                <x-heroicon-s-cash @click="view('x-heroicon-s-cash')" class="w-full" />
                <x-heroicon-s-chart-bar @click="view('x-heroicon-s-chart-bar')" class="w-full" />
                <x-heroicon-s-chart-pie @click="view('x-heroicon-s-chart-pie')" class="w-full" />
                <x-heroicon-s-chart-square-bar @click="view('x-heroicon-s-chart-square-bar')" class="w-full" />
                <x-heroicon-s-chat-alt-2 @click="view('x-heroicon-s-chat-alt-2')" class="w-full" />
                <x-heroicon-s-chat-alt @click="view('x-heroicon-s-chat-alt')" class="w-full" />
                <x-heroicon-s-chat @click="view('x-heroicon-s-chat')" class="w-full" />
                <x-heroicon-s-check-circle @click="view('x-heroicon-s-check-circle')" class="w-full" />
                <x-heroicon-s-check @click="view('x-heroicon-s-check')" class="w-full" />
                <x-heroicon-s-chevron-double-down @click="view('x-heroicon-s-chevron-double-down')" class="w-full" />
                <x-heroicon-s-chevron-double-left @click="view('x-heroicon-s-chevron-double-left')" class="w-full" />
                <x-heroicon-s-chevron-double-right @click="view('x-heroicon-s-chevron-double-right')" class="w-full" />
                <x-heroicon-s-chevron-double-up @click="view('x-heroicon-s-chevron-double-up')" class="w-full" />
                <x-heroicon-s-chevron-down @click="view('x-heroicon-s-chevron-down')" class="w-full" />
                <x-heroicon-s-chevron-left @click="view('x-heroicon-s-chevron-left')" class="w-full" />
                <x-heroicon-s-chevron-right @click="view('x-heroicon-s-chevron-right')" class="w-full" />
                <x-heroicon-s-chevron-up @click="view('x-heroicon-s-chevron-up')" class="w-full" />
                <x-heroicon-s-chip @click="view('x-heroicon-s-chip')" class="w-full" />
                <x-heroicon-s-clipboard-check @click="view('x-heroicon-s-clipboard-check')" class="w-full" />
                <x-heroicon-s-clipboard-copy @click="view('x-heroicon-s-clipboard-copy')" class="w-full" />
                <x-heroicon-s-clipboard-list @click="view('x-heroicon-s-clipboard-list')" class="w-full" />
                <x-heroicon-s-clipboard @click="view('x-heroicon-s-clipboard')" class="w-full" />
                <x-heroicon-s-clock @click="view('x-heroicon-s-clock')" class="w-full" />
                <x-heroicon-s-cloud-download @click="view('x-heroicon-s-cloud-download')" class="w-full" />
                <x-heroicon-s-cloud-upload @click="view('x-heroicon-s-cloud-upload')" class="w-full" />
                <x-heroicon-s-cloud @click="view('x-heroicon-s-cloud')" class="w-full" />
                <x-heroicon-s-code @click="view('x-heroicon-s-code')" class="w-full" />
                <x-heroicon-s-cog @click="view('x-heroicon-s-cog')" class="w-full" />
                <x-heroicon-s-collection @click="view('x-heroicon-s-collection')" class="w-full" />
                <x-heroicon-s-color-swatch @click="view('x-heroicon-s-color-swatch')" class="w-full" />
                <x-heroicon-s-credit-card @click="view('x-heroicon-s-credit-card')" class="w-full" />
                <x-heroicon-s-cube-transparent @click="view('x-heroicon-s-cube-transparent')" class="w-full" />
                <x-heroicon-s-cube @click="view('x-heroicon-s-cube')" class="w-full" />
                <x-heroicon-s-currency-bangladeshi @click="view('x-heroicon-s-currency-bangladeshi')" class="w-full" />
                <x-heroicon-s-currency-dollar @click="view('x-heroicon-s-currency-dollar')" class="w-full" />
                <x-heroicon-s-currency-euro @click="view('x-heroicon-s-currency-euro')" class="w-full" />
                <x-heroicon-s-currency-pound @click="view('x-heroicon-s-currency-pound')" class="w-full" />
                <x-heroicon-s-currency-rupee @click="view('x-heroicon-s-currency-rupee')" class="w-full" />
                <x-heroicon-s-currency-yen @click="view('x-heroicon-s-currency-yen')" class="w-full" />
                <x-heroicon-s-cursor-click @click="view('x-heroicon-s-cursor-click')" class="w-full" />
                <x-heroicon-s-database @click="view('x-heroicon-s-database')" class="w-full" />
                <x-heroicon-s-desktop-computer @click="view('x-heroicon-s-desktop-computer')" class="w-full" />
                <x-heroicon-s-device-mobile @click="view('x-heroicon-s-device-mobile')" class="w-full" />
                <x-heroicon-s-device-tablet @click="view('x-heroicon-s-device-tablet')" class="w-full" />
                <x-heroicon-s-document-add @click="view('x-heroicon-s-document-add')" class="w-full" />
                <x-heroicon-s-document-download @click="view('x-heroicon-s-document-download')" class="w-full" />
                <x-heroicon-s-document-duplicate @click="view('x-heroicon-s-document-duplicate')" class="w-full" />
                <x-heroicon-s-document-remove @click="view('x-heroicon-s-document-remove')" class="w-full" />
                <x-heroicon-s-document-report @click="view('x-heroicon-s-document-report')" class="w-full" />
                <x-heroicon-s-document-search @click="view('x-heroicon-s-document-search')" class="w-full" />
                <x-heroicon-s-document-text @click="view('x-heroicon-s-document-text')" class="w-full" />
                <x-heroicon-s-document @click="view('x-heroicon-s-document')" class="w-full" />
                <x-heroicon-s-dots-circle-horizontal @click="view('x-heroicon-s-dots-circle-horizontal')"
                    class="w-full" />
                <x-heroicon-s-dots-horizontal @click="view('x-heroicon-s-dots-horizontal')" class="w-full" />
                <x-heroicon-s-dots-vertical @click="view('x-heroicon-s-dots-vertical')" class="w-full" />
                <x-heroicon-s-download @click="view('x-heroicon-s-download')" class="w-full" />
                <x-heroicon-s-duplicate @click="view('x-heroicon-s-duplicate')" class="w-full" />
                <x-heroicon-s-emoji-happy @click="view('x-heroicon-s-emoji-happy')" class="w-full" />
                <x-heroicon-s-emoji-sad @click="view('x-heroicon-s-emoji-sad')" class="w-full" />
                <x-heroicon-s-exclamation-circle @click="view('x-heroicon-s-exclamation-circle')" class="w-full" />
                <x-heroicon-s-exclamation @click="view('x-heroicon-s-exclamation')" class="w-full" />
                <x-heroicon-s-external-link @click="view('x-heroicon-s-external-link')" class="w-full" />
                <x-heroicon-s-eye-off @click="view('x-heroicon-s-eye-off')" class="w-full" />
                <x-heroicon-s-eye @click="view('x-heroicon-s-eye')" class="w-full" />
                <x-heroicon-s-fast-forward @click="view('x-heroicon-s-fast-forward')" class="w-full" />
                <x-heroicon-s-film @click="view('x-heroicon-s-film')" class="w-full" />
                <x-heroicon-s-filter @click="view('x-heroicon-s-filter')" class="w-full" />
                <x-heroicon-s-finger-print @click="view('x-heroicon-s-finger-print')" class="w-full" />
                <x-heroicon-s-fire @click="view('x-heroicon-s-fire')" class="w-full" />
                <x-heroicon-s-flag @click="view('x-heroicon-s-flag')" class="w-full" />
                <x-heroicon-s-folder-add @click="view('x-heroicon-s-folder-add')" class="w-full" />
                <x-heroicon-s-folder-download @click="view('x-heroicon-s-folder-download')" class="w-full" />
                <x-heroicon-s-folder-open @click="view('x-heroicon-s-folder-open')" class="w-full" />
                <x-heroicon-s-folder @click="view('x-heroicon-s-folder')" class="w-full" />
                <x-heroicon-s-gift @click="view('x-heroicon-s-gift')" class="w-full" />
                <x-heroicon-s-globe-alt @click="view('x-heroicon-s-globe-alt')" class="w-full" />
                <x-heroicon-s-globe @click="view('x-heroicon-s-globe')" class="w-full" />
                <x-heroicon-s-hand @click="view('x-heroicon-s-hand')" class="w-full" />
                <x-heroicon-s-hashtag @click="view('x-heroicon-s-hashtag')" class="w-full" />
                <x-heroicon-s-heart @click="view('x-heroicon-s-heart')" class="w-full" />
                <x-heroicon-s-home @click="view('x-heroicon-s-home')" class="w-full" />
                <x-heroicon-s-identification @click="view('x-heroicon-s-identification')" class="w-full" />
                <x-heroicon-s-inbox-in @click="view('x-heroicon-s-inbox-in')" class="w-full" />
                <x-heroicon-s-inbox @click="view('x-heroicon-s-inbox')" class="w-full" />
                <x-heroicon-s-information-circle @click="view('x-heroicon-s-information-circle')" class="w-full" />
                <x-heroicon-s-key @click="view('x-heroicon-s-key')" class="w-full" />
                <x-heroicon-s-library @click="view('x-heroicon-s-library')" class="w-full" />
                <x-heroicon-s-light-bulb @click="view('x-heroicon-s-light-bulb')" class="w-full" />
                <x-heroicon-s-lightning-bolt @click="view('x-heroicon-s-lightning-bolt')" class="w-full" />
                <x-heroicon-s-link @click="view('x-heroicon-s-link')" class="w-full" />
                <x-heroicon-s-location-marker @click="view('x-heroicon-s-location-marker')" class="w-full" />
                <x-heroicon-s-lock-closed @click="view('x-heroicon-s-lock-closed')" class="w-full" />
                <x-heroicon-s-lock-open @click="view('x-heroicon-s-lock-open')" class="w-full" />
                <x-heroicon-s-login @click="view('x-heroicon-s-login')" class="w-full" />
                <x-heroicon-s-logout @click="view('x-heroicon-s-logout')" class="w-full" />
                <x-heroicon-s-mail-open @click="view('x-heroicon-s-mail-open')" class="w-full" />
                <x-heroicon-s-mail @click="view('x-heroicon-s-mail')" class="w-full" />
                <x-heroicon-s-map @click="view('x-heroicon-s-map')" class="w-full" />
                <x-heroicon-s-menu-alt-1 @click="view('x-heroicon-s-menu-alt-1')" class="w-full" />
                <x-heroicon-s-menu-alt-2 @click="view('x-heroicon-s-menu-alt-2')" class="w-full" />
                <x-heroicon-s-menu-alt-3 @click="view('x-heroicon-s-menu-alt-3')" class="w-full" />
                <x-heroicon-s-menu-alt-4 @click="view('x-heroicon-s-menu-alt-4')" class="w-full" />
                <x-heroicon-s-menu @click="view('x-heroicon-s-menu')" class="w-full" />
                <x-heroicon-s-microphone @click="view('x-heroicon-s-microphone')" class="w-full" />
                <x-heroicon-s-minus-circle @click="view('x-heroicon-s-minus-circle')" class="w-full" />
                <x-heroicon-s-minus-sm @click="view('x-heroicon-s-minus-sm')" class="w-full" />
                <x-heroicon-s-minus @click="view('x-heroicon-s-minus')" class="w-full" />
                <x-heroicon-s-moon @click="view('x-heroicon-s-moon')" class="w-full" />
                <x-heroicon-s-music-note @click="view('x-heroicon-s-music-note')" class="w-full" />
                <x-heroicon-s-newspaper @click="view('x-heroicon-s-newspaper')" class="w-full" />
                <x-heroicon-s-office-building @click="view('x-heroicon-s-office-building')" class="w-full" />
                <x-heroicon-s-paper-airplane @click="view('x-heroicon-s-paper-airplane')" class="w-full" />
                <x-heroicon-s-paper-clip @click="view('x-heroicon-s-paper-clip')" class="w-full" />
                <x-heroicon-s-pause @click="view('x-heroicon-s-pause')" class="w-full" />
                <x-heroicon-s-pencil-alt @click="view('x-heroicon-s-pencil-alt')" class="w-full" />
                <x-heroicon-s-pencil @click="view('x-heroicon-s-pencil')" class="w-full" />
                <x-heroicon-s-phone-incoming @click="view('x-heroicon-s-phone-incoming')" class="w-full" />
                <x-heroicon-s-phone-missed-call @click="view('x-heroicon-s-phone-missed-call')" class="w-full" />
                <x-heroicon-s-phone-outgoing @click="view('x-heroicon-s-phone-outgoing')" class="w-full" />
                <x-heroicon-s-phone @click="view('x-heroicon-s-phone')" class="w-full" />
                <x-heroicon-s-photograph @click="view('x-heroicon-s-photograph')" class="w-full" />
                <x-heroicon-s-play @click="view('x-heroicon-s-play')" class="w-full" />
                <x-heroicon-s-plus-circle @click="view('x-heroicon-s-plus-circle')" class="w-full" />
                <x-heroicon-s-plus-sm @click="view('x-heroicon-s-plus-sm')" class="w-full" />
                <x-heroicon-s-plus @click="view('x-heroicon-s-plus')" class="w-full" />
                <x-heroicon-s-presentation-chart-bar @click="view('x-heroicon-s-presentation-chart-bar')"
                    class="w-full" />
                <x-heroicon-s-presentation-chart-line @click="view('x-heroicon-s-presentation-chart-line')"
                    class="w-full" />
                <x-heroicon-s-printer @click="view('x-heroicon-s-printer')" class="w-full" />
                <x-heroicon-s-puzzle @click="view('x-heroicon-s-puzzle')" class="w-full" />
                <x-heroicon-s-qrcode @click="view('x-heroicon-s-qrcode')" class="w-full" />
                <x-heroicon-s-question-mark-circle @click="view('x-heroicon-s-question-mark-circle')" class="w-full" />
                <x-heroicon-s-receipt-refund @click="view('x-heroicon-s-receipt-refund')" class="w-full" />
                <x-heroicon-s-receipt-tax @click="view('x-heroicon-s-receipt-tax')" class="w-full" />
                <x-heroicon-s-refresh @click="view('x-heroicon-s-refresh')" class="w-full" />
                <x-heroicon-s-reply @click="view('x-heroicon-s-reply')" class="w-full" />
                <x-heroicon-s-rewind @click="view('x-heroicon-s-rewind')" class="w-full" />
                <x-heroicon-s-rss @click="view('x-heroicon-s-rss')" class="w-full" />
                <x-heroicon-s-save-as @click="view('x-heroicon-s-save-as')" class="w-full" />
                <x-heroicon-s-save @click="view('x-heroicon-s-save')" class="w-full" />
                <x-heroicon-s-scale @click="view('x-heroicon-s-scale')" class="w-full" />
                <x-heroicon-s-scissors @click="view('x-heroicon-s-scissors')" class="w-full" />
                <x-heroicon-s-search-circle @click="view('x-heroicon-s-search-circle')" class="w-full" />
                <x-heroicon-s-search @click="view('x-heroicon-s-search')" class="w-full" />
                <x-heroicon-s-selector @click="view('x-heroicon-s-selector')" class="w-full" />
                <x-heroicon-s-server @click="view('x-heroicon-s-server')" class="w-full" />
                <x-heroicon-s-share @click="view('x-heroicon-s-share')" class="w-full" />
                <x-heroicon-s-shield-exclamation @click="view('x-heroicon-s-shield-exclamation')" class="w-full" />
                <x-heroicon-s-shopping-bag @click="view('x-heroicon-s-shopping-bag')" class="w-full" />
                <x-heroicon-s-shopping-cart @click="view('x-heroicon-s-shopping-cart')" class="w-full" />
                <x-heroicon-s-sort-ascending @click="view('x-heroicon-s-sort-ascending')" class="w-full" />
                <x-heroicon-s-sort-descending @click="view('x-heroicon-s-sort-descending')" class="w-full" />
                <x-heroicon-s-sparkles @click="view('x-heroicon-s-sparkles')" class="w-full" />
                <x-heroicon-s-speakerphone @click="view('x-heroicon-s-speakerphone')" class="w-full" />
                <x-heroicon-s-star @click="view('x-heroicon-s-star')" class="w-full" />
                <x-heroicon-s-status-offline @click="view('x-heroicon-s-status-offline')" class="w-full" />
                <x-heroicon-s-status-online @click="view('x-heroicon-s-status-online')" class="w-full" />
                <x-heroicon-s-stop @click="view('x-heroicon-s-stop')" class="w-full" />
                <x-heroicon-s-sun @click="view('x-heroicon-s-sun')" class="w-full" />
                <x-heroicon-s-support @click="view('x-heroicon-s-support')" class="w-full" />
                <x-heroicon-s-switch-horizontal @click="view('x-heroicon-s-switch-horizontal')" class="w-full" />
                <x-heroicon-s-switch-vertical @click="view('x-heroicon-s-switch-vertical')" class="w-full" />
                <x-heroicon-s-table @click="view('x-heroicon-s-table')" class="w-full" />
                <x-heroicon-s-tag @click="view('x-heroicon-s-tag')" class="w-full" />
                <x-heroicon-s-template @click="view('x-heroicon-s-template')" class="w-full" />
                <x-heroicon-s-terminal @click="view('x-heroicon-s-terminal')" class="w-full" />
                <x-heroicon-s-thumb-down @click="view('x-heroicon-s-thumb-down')" class="w-full" />
                <x-heroicon-s-thumb-up @click="view('x-heroicon-s-thumb-up')" class="w-full" />
                <x-heroicon-s-ticket @click="view('x-heroicon-s-ticket')" class="w-full" />
                <x-heroicon-s-translate @click="view('x-heroicon-s-translate')" class="w-full" />
                <x-heroicon-s-trash @click="view('x-heroicon-s-trash')" class="w-full" />
                <x-heroicon-s-trending-down @click="view('x-heroicon-s-trending-down')" class="w-full" />
                <x-heroicon-s-trending-up @click="view('x-heroicon-s-trending-up')" class="w-full" />
                <x-heroicon-s-truck @click="view('x-heroicon-s-truck')" class="w-full" />
                <x-heroicon-s-upload @click="view('x-heroicon-s-upload')" class="w-full" />
                <x-heroicon-s-user-add @click="view('x-heroicon-s-user-add')" class="w-full" />
                <x-heroicon-s-user-circle @click="view('x-heroicon-s-user-circle')" class="w-full" />
                <x-heroicon-s-user-group @click="view('x-heroicon-s-user-group')" class="w-full" />
                <x-heroicon-s-user-remove @click="view('x-heroicon-s-user-remove')" class="w-full" />
                <x-heroicon-s-user @click="view('x-heroicon-s-user')" class="w-full" />
                <x-heroicon-s-users @click="view('x-heroicon-s-users')" class="w-full" />
                <x-heroicon-s-variable @click="view('x-heroicon-s-variable')" class="w-full" />
                <x-heroicon-s-video-camera @click="view('x-heroicon-s-video-camera')" class="w-full" />
                <x-heroicon-s-view-boards @click="view('x-heroicon-s-view-boards')" class="w-full" />
                <x-heroicon-s-view-grid-add @click="view('x-heroicon-s-view-grid-add')" class="w-full" />
                <x-heroicon-s-view-grid @click="view('x-heroicon-s-view-grid')" class="w-full" />
                <x-heroicon-s-view-list @click="view('x-heroicon-s-view-list')" class="w-full" />
                <x-heroicon-s-volume-off @click="view('x-heroicon-s-volume-off')" class="w-full" />
                <x-heroicon-s-volume-up @click="view('x-heroicon-s-volume-up')" class="w-full" />
                <x-heroicon-s-wifi @click="view('x-heroicon-s-wifi')" class="w-full" />
                <x-heroicon-s-x-circle @click="view('x-heroicon-s-x-circle')" class="w-full" />
                <x-heroicon-s-x @click="view('x-heroicon-s-x')" class="w-full" />
                <x-heroicon-s-zoom-in @click="view('x-heroicon-s-zoom-in')" class="w-full" />
                <x-heroicon-s-zoom-out @click="view('x-heroicon-s-zoom-out')" class="w-full" />
            </div>

        </div>

    </div>
</x-app-layout>