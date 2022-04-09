<template>
  <nav id="navbar-main" class="navbar is-fixed-top">
    <div class="navbar-brand">
      <a class="navbar-item is-hidden-desktop jb-aside-mobile-toggle">
        <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
      </a>
      <div class="navbar-item has-control">
        <div class="control"></div>
      </div>
    </div>
    <div class="navbar-brand is-right">
      <a
        class="navbar-item is-hidden-desktop jb-navbar-menu-toggle"
        data-target="navbar-menu"
      >
        <span class="icon"><i class="mdi mdi-dots-vertical"></i></span>
      </a>
    </div>
    <div class="navbar-menu fadeIn animated faster" id="navbar-menu">
      <div class="navbar-end">
        <div
          class="
            navbar-item
            has-dropdown has-dropdown-with-icons has-divider has-user-avatar
            is-hoverable
          "
        >
          <a class="navbar-link is-arrowless">
            <div class="is-user-avatar">
              <img
                src="https://avatars.dicebear.com/v2/initials/john-doe.svg"
                alt="John Doe"
              />
            </div>
            <div class="is-user-name">
              <span>{{ userData.name }}</span>
            </div>
            <span class="icon"><i class="mdi mdi-chevron-down"></i></span>
          </a>
          <div class="navbar-dropdown">
            <nuxt-link
              tag="a"
              :to="localePath(`/my-profile`)"
              class="navbar-item"
            >
              <span class="icon"><i class="mdi mdi-account"></i></span>
              <span>{{ $t('nav.my_profile') }}</span>
            </nuxt-link>
            <nuxt-link
              tag="a"
              :to="localePath(`/my-products`)"
              class="navbar-item"
            >
              <span class="icon"><i class="mdi mdi-email"></i></span>
              <span>{{ $t('nav.my_products') }}</span>
            </nuxt-link>
            <hr class="navbar-divider" />
            <a class="navbar-item">
              <span class="icon"><i class="mdi mdi-logout"></i></span>
              <nuxt-link tag="span" to="/logout">
                {{ $t('nav.logout') }}</nuxt-link
              >
            </a>
          </div>
        </div>
        <a class="navbar-item">
          <client-only>
            <langSwitcher />
          </client-only>
        </a>
        <nuxt-link
          tag="a"
          to="/"
          :title="this.$t('nav.about')"
          class="navbar-item has-divider is-desktop-icon-only about-icon"
        >
          <span class="icon"><i class="mdi mdi-help-circle-outline"></i></span>
          <span>{{ $t('nav.about') }}</span>
        </nuxt-link>

        <nuxt-link
          tag="a"
          to="/logout"
          :title="this.$t('nav.logout')"
          class="navbar-item is-desktop-icon-only"
        >
          <span class="icon"><i class="mdi mdi-logout"></i></span>
          <span>{{ $t('nav.logout') }}</span>
        </nuxt-link>
      </div>
    </div>
  </nav>
</template>
<script>
import langSwitcher from '~/components/langSwitcher'
export default {
  data() {
    return {
      userData: [],
      error_server: null,
    }
  },
  name: 'Nav',
  components: {
    langSwitcher,
  },
  mounted() {
    this.getDataUser()
  },
  methods: {
    async getDataUser() {
      await this.$axios
        .get(`/user`, {
          headers: {
            Authorization: `Bearer ${this.$auth.strategy.token.get()}`,
            'Content-Type': 'application/json',
          },
        })
        .then((response) => {
          this.userData = response.data.result
        })
        .catch((error) => {
          this.error_server = error.response.data.error
        })
    },
  },
  // async asyncData({ store, $axios }) {
  //   let response = await $axios.get(`/user`)
  //   userData = response.data.result
  //   return {
  //     userData,
  //   }
  // },
}
</script>
<style scoped>
.about-icon {
  background-color: unset !important;
  color: #4a4a4a !important;
}
</style>