require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import icons from './fontawesome'

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'


library.add({ ...icons });



const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'KanBan Board';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .component('font-awesome-icon', FontAwesomeIcon)
            .use(plugin)
            .mixin({ methods: { route } })
            .mount(el);
            
    },
});

InertiaProgress.init({ color: '#4B5563' });
