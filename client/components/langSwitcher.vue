<template>
  <div>
    <!-- <b-dropdown :text="$i18n.locale">
      <b-dropdown-item
        v-for="locale in $i18n.locales"
        :key="locale.code"
        @click="changeLocale(locale.code)"
      >
        {{ locale.name }}</b-dropdown-item
      >
    </b-dropdown> -->

    <b-dropdown aria-role="list">
      <template #trigger="{ active }">
        <b-button
          :label="$i18n.locale"
          type="is-primary"
          :icon-right="active ? 'menu-up' : 'menu-down'"
          class="lang-switch"
        />
      </template>
      <b-dropdown-item
        v-for="locale in $i18n.locales"
        :key="locale.code"
        @click="changeLocale(locale.code)"
      >
        {{ locale.name }}</b-dropdown-item
      >
    </b-dropdown>
  </div>
</template>
<script>
export default {
  methods: {
    changeLocale(locale) {
      this.$i18n.setLocaleCookie(locale)
      this.$router.push(this.switchLocalePath(locale))
    },
  },
}
</script>
<style scoped>
.lang-switch {
  background-color: unset !important;
  color: #4a4a4a !important;
}
</style>