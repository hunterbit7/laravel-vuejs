<template>
  <!--Start here-->
  <section class="page-start">
    <section class="hero is-hero-bar">
      <div class="hero-body">
        <div class="level">
          <div class="level-left">
            <div class="level-item">
              <h1 class="title">{{ $t('dashboard.title') }}</h1>
            </div>
          </div>
          <div class="level-right" style="display: none">
            <div class="level-item"></div>
          </div>
        </div>
      </div>
    </section>
    <section class="section is-main-section">
      <div class="tile is-ancestor">
        <div class="tile is-parent">
          <div class="card tile is-child">
            <div class="card-content">
              <div class="level is-mobile">
                <div class="level-item">
                  <div class="is-widget-label">
                    <h3 class="subtitle is-spaced">
                      {{ $t('dashboard.clients') }}
                    </h3>
                    <h1 class="title">512</h1>
                  </div>
                </div>
                <div class="level-item has-widget-icon">
                  <div class="is-widget-icon">
                    <span class="icon has-text-primary is-large"
                      ><i class="mdi mdi-account-multiple mdi-48px"></i
                    ></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tile is-parent">
          <div class="card tile is-child">
            <div class="card-content">
              <div class="level is-mobile">
                <div class="level-item">
                  <div class="is-widget-label">
                    <h3 class="subtitle is-spaced">
                      {{ $t('dashboard.sales') }}
                    </h3>
                    <h1 class="title">$7,770</h1>
                  </div>
                </div>
                <div class="level-item has-widget-icon">
                  <div class="is-widget-icon">
                    <span class="icon has-text-info is-large"
                      ><i class="mdi mdi-cart-outline mdi-48px"></i
                    ></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tile is-parent">
          <div class="card tile is-child">
            <div class="card-content">
              <div class="level is-mobile">
                <div class="level-item">
                  <div class="is-widget-label">
                    <h3 class="subtitle is-spaced">
                      {{ $t('dashboard.performance') }}
                    </h3>
                    <h1 class="title">256%</h1>
                  </div>
                </div>
                <div class="level-item has-widget-icon">
                  <div class="is-widget-icon">
                    <span class="icon has-text-success is-large"
                      ><i class="mdi mdi-finance mdi-48px"></i
                    ></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
</template>

<script>
export default {
  middleware: 'auth',
  data() {
    return {}
  },
  components: {},
  methods: {},
}
</script>
<style scoped>
img {
  width: 100px !important;
}
.padding-top-50px {
  padding-top: 50px;
}
</style>
