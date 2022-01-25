function makeRequest(request, type){
  var form = document.getElementByID(adminForm);
  form.setAttribute('method', type);
  form.setAttribute('action', 'http://localhost:9103/interoperability/api/admin/' + request);
}
