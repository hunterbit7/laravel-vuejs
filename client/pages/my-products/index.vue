<template>
  <section class="page-start">
    <b-field grouped group-multiline>
      <div class="function-buttons">
        <b-button
          :label="this.$t('my-products.delete')"
          type="is-danger"
          icon-left="delete"
          class="field custom-button"
          @click="confirmDeleteSelected"
        />
        <b-button
          :label="this.$t('my-products.find')"
          type="is-danger"
          icon-left="search"
          class="field custom-button"
          @click="searchOn = !searchOn"
        />
        <b-button
          :label="this.$t('my-products.add')"
          type="is-danger"
          icon-left="plus"
          class="field custom-button"
          @click="showCreateModal = true"
        />
      </div>
    </b-field>

    <b-table
      class="table-products"
      :debounce-search="1000"
      :data="data"
      :checked-rows.sync="checkedRows"
      checkable
      :checkbox-position="checkboxPosition"
      :paginated="isPaginated"
      :per-page="perPage"
      :current-page.sync="currentPage"
    >
      <b-table-column
        :label="this.$t('my-products.name')"
        width="40"
        field="name"
        :searchable="searchOn"
        v-slot="props"
      >
        {{ props.row.name }}
      </b-table-column>
      <b-table-column
        :label="this.$t('my-products.barcode')"
        width="40"
        v-slot="props"
        field="barcode"
        :searchable="searchOn"
      >
        {{ props.row.barcode }}
      </b-table-column>
      <b-table-column
        :label="this.$t('my-products.price')"
        width="40"
        v-slot="props"
        field="price"
        :searchable="searchOn"
      >
        {{ props.row.price }}€
      </b-table-column>
      <b-table-column
        :label="this.$t('my-products.quantity')"
        width="40"
        v-slot="props"
        field="quantity"
        :searchable="searchOn"
      >
        {{ props.row.quantity }}
      </b-table-column>
      <b-table-column
        :label="this.$t('my-products.actions')"
        width="40"
        v-slot="props"
      >
        <i
          class="fas fa-eye mr-2"
          @click.prevent="viewProduct(props.row.id)"
        ></i>
        <i
          class="fas fa-edit mr-2"
          @click.prevent="editProduct(props.row.id)"
        ></i>
        <i
          class="fas fa-trash mr-2"
          @click.prevent="confirmDelete(props.row.id)"
        ></i>
      </b-table-column>
    </b-table>
    <b-loading v-model="isLoading" :can-cancel="true"></b-loading>
    <PopupCreateProduct
      v-if="showCreateModal"
      @close="hideModal()"
      @reload-data="getProducts()"
    />
  </section>
</template>

<script>
import PopupCreateProduct from '@/components/popup/PopupCreateProduct'
export default {
  data() {
    // const data = []

    return {
      // data,
      isPaginated: true,
      searchOn: false,
      currentPage: 1,
      perPage: 5,
      showCreateModal: false,
      isLoading: false,
      productsData: [],
      checkboxPosition: 'left',
      checkedRows: [],
      arrayDelete: [],
      error_server: [],
      columns: [
        // {
        //   field: 'id',
        //   label: 'ID',
        //   width: '40',
        //   numeric: true,
        // },
        {
          field: 'name',
          label: this.$t('my-products.name'),
        },
        {
          field: 'barcode',
          label: this.$t('my-products.barcode'),
        },
        {
          field: 'price',
          label: this.$t('my-products.price'),
        },
        {
          field: 'quantity',
          label: this.$t('my-products.quantity'),
        },
      ],
    }
  },
  components: { PopupCreateProduct },
  mounted() {
    this.getProducts()
  },
  computed: {
    data() {
      return this.$store.state.products.dataListCustomers
    },
  },
  methods: {
    async getProducts() {
      this.isLoading = true
      await this.$axios
        .get(`/products?page=1`, {
          headers: {
            Authorization: `Bearer ${this.$auth.strategy.token.get()}`,
            'Content-Type': 'application/json',
          },
        })
        .then((response) => {
          let getData = response.data.result.data
          this.$store.commit('products/SET_DATA', getData)
          this.isLoading = false
        })
        .catch((error) => {
          this.error_server = error.response.data.error
        })
    },
    editProduct(id) {
      this.$router.push(this.localePath(`/my-products/${id}`))
    },
    viewProduct(id) {
      this.$router.push(this.localePath(`/my-products/view/${id}`))
    },
    confirmDelete(val) {
      this.$buefy.dialog.confirm({
        message: this.$t('my-products.continue'),
        onConfirm: () => this.deleteProduct(val),
      })
    },
    async deleteProduct(id) {
      this.isLoading = true
      await this.$axios
        .delete(`/products/${id}`, {
          headers: {
            Authorization: `Bearer ${this.$auth.strategy.token.get()}`,
            'Content-Type': 'application/json',
          },
        })
        .then((response) => {
          this.getProducts()
          this.isLoading = false
          this.deletedNotification()
        })
        .catch((error) => {
          this.error_server = error.response.data.error
        })
    },
    confirmDeleteSelected() {
      this.$buefy.dialog.confirm({
        message: this.$t('my-products.continue'),
        onConfirm: () => this.deleteSelected(),
      })
    },
    async deleteSelected() {
      this.checkedRows.forEach((element) => {
        this.arrayDelete.push(element.id)
      })
      this.isLoading = true
      await this.$axios
        .delete(`/products/`, {
          data: { ids: this.arrayDelete },
          headers: {
            Authorization: `Bearer ${this.$auth.strategy.token.get()}`,
            'Content-Type': 'application/json',
          },
        })
        .then((response) => {
          this.getProducts()
          this.isLoading = false
          this.deletedNotificationSelected()
        })
        .catch((error) => {
          this.error_server = error.response.data.error
        })
    },
    deletedNotification() {
      this.$buefy.notification.open({
        message: this.$t('my-products.notifications.product_deleted'),
        type: 'is-danger',
      })
    },
    deletedNotificationSelected() {
      this.$buefy.notification.open({
        message: this.$t('my-products.notifications.product_deleted_selected'),
        type: 'is-danger',
      })
    },
    hideModal() {
      this.showCreateModal = false
    },
  },
}
</script>
<style scoped>
.table-products {
  padding-top: 30px !important;
  padding-left: 20px !important;
  padding-right: 20px !important;
}
.custom-button {
  background-color: #2e323a !important;
}
</style>
