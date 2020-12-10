import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import {InertiaProgress} from '@inertiajs/progress'

InertiaProgress.init()
Vue.use(plugin)
Vue.mixin({
    methods: {
        route: (name, params, absolute, config = Ziggy) => route(name, params, absolute, config),
    }
})

const el = document.getElementById('app')

new Vue({
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => require(`./Pages/${name}`).default,
        },
    }),
}).$mount(el)
