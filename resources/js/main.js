import { createApp, h } from 'vue'
import { createInertiaApp, router } from '@inertiajs/vue3'
import { createPinia } from 'pinia'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap'
import 'vue3-carousel/dist/carousel.css'
import './style.css'

import NProgress from 'nprogress'
import 'nprogress/nprogress.css'

// Custom NProgress color
const nprogressCustomStyle = document.createElement('style')
nprogressCustomStyle.innerHTML = `
#nprogress .bar {
  background: #ff2222 !important; /* Change this to your desired color */
}
#nprogress .peg {
  box-shadow: 0 0 10px #ff2222, 0 0 5px #ff2222 !important;
}
#nprogress .spinner-icon {
  border-top-color: #ff2222 !important;
  border-left-color: #ff2222 !important;
}
`
document.head.appendChild(nprogressCustomStyle)

// Inertia progress bar
NProgress.configure({ showSpinner: false })
router.on('start', () => NProgress.start())
router.on('finish', () => NProgress.done())
router.on('error', () => NProgress.done())

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faUserSecret, faLocationDot, faBasketShopping, faPersonCirclePlus, faStarHalfStroke, faStar, faPersonBiking, faStore, faCartPlus } from '@fortawesome/free-solid-svg-icons'
import { faFacebookF, faTwitter, faInstagram, faYoutube, faAppStore, faGooglePlay } from '@fortawesome/free-brands-svg-icons'
import { faCircleDown, faTrashCan, faPenToSquare, faCircleRight } from '@fortawesome/free-regular-svg-icons'

/* add icons to the library */
library.add(faUserSecret, faStar, faStar, faFacebookF, faTwitter, faInstagram, faYoutube, faAppStore, faGooglePlay, faLocationDot, faBasketShopping, faCircleDown, faPersonCirclePlus, faStarHalfStroke, faTrashCan, faPenToSquare, faPersonBiking, faCircleRight, faStore, faCartPlus)

// Create Pinia instance
const pinia = createPinia()

// Inertia app setup
createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./pages/**/*.vue', { eager: true });
    return pages[`./pages/${name}.vue`];
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(pinia)
      .component('font-awesome-icon', FontAwesomeIcon)
      .mount(el)
  },
})
