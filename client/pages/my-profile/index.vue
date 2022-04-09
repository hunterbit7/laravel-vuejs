<template>
  <div class="page-start">
    <div class="tile is-parent">
      <div class="card tile is-child">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-account default"></i></span>
            {{ $t('my-profile.title') }}
          </p>
        </header>
        <div class="card-content">
          <div class="is-user-avatar image has-max-width is-aligned-center">
            <img
              src="https://avatars.dicebear.com/v2/initials/john-doe.svg"
              alt="John Doe"
            />
          </div>
          <hr />
          <div class="field">
            <label class="label">{{ $t('my-profile.name') }}</label>
            <div class="control is-clearfix">
              <input
                type="text"
                readonly=""
                v-model="userData.name"
                class="input is-static"
              />
            </div>
          </div>
          <hr />
          <div class="field">
            <label class="label">{{ $t('my-profile.email') }}</label>
            <div class="control is-clearfix">
              <input
                type="text"
                readonly=""
                v-model="userData.email"
                class="input is-static"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      userData: [],
      error_server: '',
    }
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
}
</script>