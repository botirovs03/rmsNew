import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import Layout from './Pages/Layout.vue'

import { library } from '@fortawesome/fontawesome-svg-core'
import { faTrashCan, faPencil, faHouse,faUsersLine,faCouch, faBars,faXmark } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faTrashCan, faPencil,faHouse,faUsersLine,faCouch, faBars,faXmark)

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    let page = pages[`./Pages/${name}.vue`]
    page.default.layout = name.startsWith('Public/') ? undefined : Layout
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component('fa', FontAwesomeIcon )
      .mount(el)
  },
})