const state = {
	user: {},
};

const getters = {
  userDetails: (state) => state.user
};

const actions = {
};

const mutations = {
  SET_USER_DATA(state, data) {
    state.user = data;
  },

  showToastMessage(state, {message, status})
  {
    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function(toastEl) {
      // Creates an array of toasts (it only initializes them)
      return new bootstrap.Toast(toastEl, { animation: true, autohide: true, delay: 2000 }) // No need for options; use the default options
    });
    // alert(message)
    $('#toast-div').css('display', 'block');
    $("#toastDiv").removeClass("bg-danger");
    $("#toastDiv").removeClass("bg-success");
    if(status == 'success')
      $("#toastDiv").addClass("bg-success");
    else
      $("#toastDiv").addClass("bg-danger");
    $('#toastMessage').html(message);
    toastList.forEach(toast => toast.show()); // This show 
    setTimeout(function(){ $('#toast-div').css('display', 'none'); }, 3000);
  },
  
};

export default {
  state,
  getters,
  actions,
  mutations
};