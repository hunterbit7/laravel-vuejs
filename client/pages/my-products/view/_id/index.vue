<template>
  <section class="page-start">
    <div class="modal-container">
      <div class="modal-header">
        <slot name="header">{{ $t('my-products.popup.title_edit') }} </slot>
      </div>

      <div class="modal-body-custom">
        <form inline @submit.stop.prevent>
          <section class="modal-card-body">
            <b-field :label="this.$t('my-products.name')">
              <b-input
                type="text"
                v-model="data.name"
                :placeholder="this.$t('my-products.popup.your_product')"
                disabled
              >
              </b-input>
            </b-field>

            <b-field :label="this.$t('my-products.barcode')">
              <b-input
                type="text"
                v-model="data.barcode"
                :placeholder="this.$t('my-products.popup.your_barcode')"
                disabled
              >
              </b-input>
            </b-field>

            <b-field :label="this.$t('my-products.price')">
              <b-input
                type="number"
                v-model="data.price"
                :placeholder="this.$t('my-products.popup.your_price')"
                disabled
              >
              </b-input>
            </b-field>

            <b-field :label="this.$t('my-products.quantity')">
              <b-input
                type="number"
                v-model="data.quantity"
                :placeholder="this.$t('my-products.quantity')"
                disabled
              >
              </b-input>
            </b-field>
          </section>
          <div class="modal-card-body" v-if="error_server">
            <p class="error-server">
              {{ error_server }}
            </p>
          </div>

          <footer class="modal-card-foot">
            <b-button
              :label="this.$t('my-products.popup.cancel')"
              @click="closeEditpage"
            />
          </footer>
          <b-loading v-model="isLoading" :can-cancel="true"></b-loading>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      labelPosition: 'on-border',
      name: null,
      quantity: null,
      barcode: null,
      price: null,
      error_server: '',
      isLoading: false,
      data: [],
    }
  },
  mounted() {
    this.getProductID()
  },
  methods: {
    async getProductID() {
      this.isLoading = true
      await this.$axios
        .get(`/products/${this.$route.params.id}`, {
          headers: {
            Authorization: `Bearer ${this.$auth.strategy.token.get()}`,
            'Content-Type': 'application/json',
          },
        })
        .then((response) => {
          this.data = response.data.result
          this.isLoading = false
        })
        .catch((error) => {
          this.error_server = error.response.data.error
        })
    },
    closeEditpage() {
      this.$router.push(this.localePath(`/my-products`))
    },
    cancel() {
      this.$emit('close')
    },
  },
  props: '',
}
</script>

<style scoped>
.error-server {
  color: red;
  font-size: 16px;
}
.field {
  width: 45% !important;
  float: left !important;
  padding-left: 5px !important;
  padding-bottom: 20px !important;
}
.list-group-list {
  list-style: none !important;
}
select {
  width: 100% !important;
}
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
.input {
  background-color: #fff;
  border-color: #dbdbdb !important;
  border-radius: 4px !important;
  color: #363636 !important;
}
.modal-container {
  max-width: 100%;
  width: 100%;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
  overflow-y: scroll;
  max-height: 100vh;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}
.modal-header {
  padding: 1rem !important;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

.anulla {
  width: 140px;
  color: #fff;
  background-color: #ce4600;
  border-radius: 8px;
  text-transform: uppercase;
  border: none;
  padding: 0.375rem 0.75rem;
  font-size: 0.9rem;
  line-height: 1.6;
  border-radius: 0.25rem;
}
.salva {
  width: 140px;
  color: #fff;
  background-color: #00af12;
  border-radius: 8px;
  text-transform: uppercase;
  border: none;
  padding: 0.375rem 0.75rem;
  font-size: 0.9rem;
  line-height: 1.6;
  border-radius: 0.25rem;
}
.modal-card-foot {
  background-color: unset !important;
}
.modal-body-custom {
  padding: 0 1rem;
  border: 1px solid #ce4600;
  border-radius: 0px;
  padding-top: 0.75rem;
}
.modal-footer {
  padding-left: 0;
  padding-right: 0;
}
.modal-header {
  text-align: center;
  font-size: 28px;
  line-height: 32px;
  font-weight: bold;
  background-color: #181824;
  color: #fff;
  margin-bottom: 0.75rem;
  border-radius: 0;
  border: none;
  display: block;
  text-transform: uppercase;
}
.modal-body-custom label {
  display: block;
}
.error {
  color: red;
  font-weight: 500;
  font-size: 14px;
}
.forma {
  width: 50%;
}
/* .forma input {
  width: 100%;
  border-radius: 4px;
  height: 35px;
} */

.col-form-label {
  text-transform: capitalize;
}
@media (max-width: 400px) {
  .anulla {
    width: 50%;
    max-width: 100px;
  }
  .salva {
    width: 50%;
    max-width: 100px;
  }
  .modal-header {
    font-size: 22px;
    line-height: 28px;
  }
}
</style>