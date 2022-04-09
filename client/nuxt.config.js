export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'SPA',
    htmlAttrs: {
      lang: 'en',
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' },
    ],
    link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
    {
      rel: 'stylesheet',
      href:
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css',
    },
  ],
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: ['@/assets/css/main.css', '@/assets/css/login.css'],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/buefy
    'nuxt-buefy',
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',
    '@nuxtjs/bulma',
    '@nuxtjs/auth-next',
    '@nuxtjs/pwa',
    [
      'nuxt-i18n',
      {
        locales: [
          {
            code: 'it',
            name: 'It',
            file: 'it.json',
          },
          {
            code: 'en',
            name: 'En',
            file: 'en.json',
          },
        ],
        lazy: true,
        langDir: 'lang/',
        defaultLocale: 'en',
        detectBrowserLanguage: {
          useCookie: true,
          cookieKey: 'i18n_redirected',
          alwaysRedirect: true,
          fallbackLocale: 'en',
        },
        vuex: {
          moduleName: 'i18n',
          syncLocale: true,
          syncMessages: true,
          syncRouteParams: true,
        },
      },
    ],
  ],

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    baseURL: 'http://localhost:8000/api',
  },
  auth: {
    strategies: {
      local: {
        token: {
          property: 'result',
          required: true,
          type: 'Bearer',
        },
        user: {
          property: '',
          autoFetch: true,
        },
        endpoints: {
          login: { url: '/login', method: 'post' },
          logout: { url: '/logout', method: 'post' },
          user: { url: '/user', method: 'get' },
        },
        redirect: {
          login: '/login',
          logout: '/',
          callback: '/login',
          home: '/',
        },
        watchLoggedIn: true,
      },
    },
  },

  // PWA module configuration: https://go.nuxtjs.dev/pwa
  pwa: {
    manifest: {
      lang: 'en',
    },
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {},
}
