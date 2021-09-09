import axios from '../../libs/axios'

export default {
  browse(filters) {
    return axios.get(`/api/customers${filters}`)
  },
}
