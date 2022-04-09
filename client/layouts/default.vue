<template>
  <div>
    <Nav id="navbar-main" class="navbar is-fixed-top navbar-right" />
    <AsideMenu class="aside is-placed-left is-expanded" />
    <Nuxt class="main-index" />
  </div>
</template>
<script>
import Nav from '~/components/Nav'
import AsideMenu from '~/components/AsideMenu'
export default {
  middleware: 'auth',
  components: {
    Nav,
    AsideMenu,
  },
}
</script>
<style scoped>
.main-index {
  margin-left: 16.6666666667%;
}
</style>