<template>
  <b-container class="mt-50">
    <b-row>
      <b-col cols="12">
        <b-overlay
          :show="customers.isLoading"
          rounded="sm"
        >
          <b-card-actions action-collapse>
            <b-img
              :src="require('@/assets/images/jumia-food.jpg')"
              alt="jumia foods logo"
              class="jumia-logo"
            />
            <b-row>
              <b-col
                cols="6"
                align-h="center"
                class="mb-1"
              >
                <label>Countries</label>
                <b-input-group>
                  <b-input-group-prepend is-text>
                    <feather-icon icon="SearchIcon" />
                  </b-input-group-prepend>
                  <b-select
                    v-model="customers.code"
                    :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                    :options="customers.countries"
                    label="text"
                    @change="browseCustomers(1)"
                  />
                </b-input-group>
              </b-col>
              <b-col
                cols="6"
                align-h="center"
                class="mb-1"
              >
                <label>Valid</label>
                <b-input-group>
                  <b-input-group-prepend is-text>
                    <feather-icon icon="SearchIcon" />
                  </b-input-group-prepend>
                  <b-select
                    v-model="customers.valid"
                    :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                    :options="customers.validOptions"
                    label="text"
                    @change="browseCustomers(1)"
                  />
                </b-input-group>
              </b-col>
              <b-col cols="12">
                <b-table
                  responsive
                  :outlined="true"
                  :items="customers.data.filter(row => row.valid === customers.valid || customers.valid === '')"
                  :fields="customers.fields"
                  :head-variant="'dark'"
                >
                  <!-- A virtual column -->
                  <template #cell(valid)="data">
                    <b-badge
                      :variant="data.item.valid ? 'success':'danger'"
                    >
                      {{ data.item.valid ? 'OK' : 'NOK' }}
                    </b-badge>
                  </template>
                  <!-- A virtual column -->
                  <template #cell(code)="data">
                    +{{ reformatPhoneCode(data.item.code) }}
                  </template>
                </b-table>
              </b-col>
              <b-col
                md="2"
                sm="4"
                xs="4"
                class="my-1"
              >
                <b-form-group class="mb-0">
                  <label class="d-inline-block text-sm-left mr-50">Per page</label>
                  <b-form-select
                    id="perPageSelect"
                    v-model="customers.recordsPerPage"
                    size="sm"
                    :options="customers.paginateOptions"
                    class="w-50"
                    @change="browseCustomers(1)"
                  />
                </b-form-group>
              </b-col>
              <b-col
                md="10"
                sm="8"
                xs="8"
                class="my-1"
              >
                <b-pagination
                  v-model="customers.meta.current_page"
                  :total-rows="customers.meta.total"
                  :per-page="customers.recordsPerPage"
                  align="right"
                  class="my-0"
                  first-number
                  last-number
                  prev-class="prev-item"
                  next-class="next-item"
                  @change="browseCustomers"
                >
                  <template #prev-text>
                    <feather-icon
                      icon="ChevronLeftIcon"
                      size="18"
                    />
                  </template>
                  <template #next-text>
                    <feather-icon
                      icon="ChevronRightIcon"
                      size="18"
                    />
                  </template>
                </b-pagination>
              </b-col>
            </b-row>
          </b-card-actions>
        </b-overlay>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>

export default {
  data: () => ({
    customers: {
      isLoading: false,
      code: '',
      valid: '',
      validOptions: [
        {
          text: 'All',
          value: '',
        },
        {
          text: 'Valid',
          value: true,
        },
        {
          text: 'Not Valid',
          value: false,
        },
      ],
      countries: [
        {
          text: 'All',
          value: '',
        },
        {
          text: 'Cameron',
          value: '237',
        },
        {
          text: 'Ethiopia',
          value: '251',
        },
        {
          text: 'Morocco',
          value: '212',
        },
        {
          text: 'Mozambique',
          value: '258',
        },
        {
          text: 'Uganda',
          value: '256',
        },
      ],
      paginateOptions: [5, 10, 25, 50, 100, 250],
      recordsPerPage: 15,
      fields: [
        { key: 'id', label: 'ID' },
        { key: 'country', label: 'Country' },
        { key: 'valid', label: 'State' },
        { key: 'code', label: 'Code' },
        { key: 'phone', label: 'Phone' },
      ],
      data: [],
      meta: {
        count: 0,
        current_page: 1,
        links: {},
        per_page: 0,
        total: 0,
        total_pages: 0,
      },
    },
  }),
  mounted() {
    this.browseCustomers(this.customers.meta.current_page)
  },
  methods: {
    browseCustomers(page = 0) {
      this.customers.isLoading = true
      this.$store.dispatch('customer/browse', `?paginate=${this.customers.recordsPerPage}&page=${page}&fields[customer]=id,phone&filter[code]=${this.customers.code}`).then(response => {
        this.customers.data = response.data.data
        this.customers.meta = response.data.meta.pagination
        this.customers.isLoading = false
      }).catch(error => {
        console.error(error)
        this.customers.isLoading = false
      })
    },
    reformatPhoneCode(code) {
      const res = code.match(/(?<=\()(.*?)(?=\))/g)
      return res.length > 0 ? res[0] : ''
    },
  },
}
</script>

<style lang="scss">
@import '~@/assets/scss/variables/_variables.scss';
.table .thead-dark th {
    background-color: $primary !important;
    border-color: $primary !important;
}
.jumia-logo {
  max-width: 150px;
  max-height: 150px;
  border-radius: 15px;
  position: relative;
  top: -35px
}
</style>
