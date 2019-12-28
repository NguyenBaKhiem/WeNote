export default {
  methods: {
    resetError () {
      this.errors.clear();
    },

    convertRemoteErrors(error) {
      const errors = error.response.data.errors || {};
      for (const field in errors) {
        for (const error of errors[field]) {
          this.errors.add({field: field, msg: error});
        }
      }
      if (!this.errors.any()) {
        this.errors.add({field: 'error', msg: 'Some error occurred. Please try again later'});
      }
    },
  },
}
