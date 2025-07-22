import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap'
import './style.css'

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faUserSecret, faLocationDot, faBasketShopping, faPersonCirclePlus, faStarHalfStroke, faStar, faPersonBiking, faStore } from '@fortawesome/free-solid-svg-icons'
import { faFacebookF, faTwitter, faInstagram, faYoutube, faAppStore, faGooglePlay } from '@fortawesome/free-brands-svg-icons'
import { faCircleDown, faTrashCan, faPenToSquare, faCircleRight } from '@fortawesome/free-regular-svg-icons'


/* add icons to the library */
library.add(faUserSecret, faStar, faStar, faFacebookF, faTwitter, faInstagram, faYoutube, faAppStore, faGooglePlay, faLocationDot, faBasketShopping, faCircleDown, faPersonCirclePlus, faStarHalfStroke, faTrashCan, faPenToSquare, faPersonBiking, faCircleRight, faStore)

// Inertia app setup
createInertiaApp({
  resolve: name => import(`./pages/${name}.vue`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component('font-awesome-icon', FontAwesomeIcon)
      .mount(el)
  },
})
