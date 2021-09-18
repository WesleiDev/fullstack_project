export function validEmailForm(val) {
  const emailPattern = /^(?=[a-zA-Z0-9@._%+-]{6,254}$)[a-zA-Z0-9._%+-]{1,64}@(?:[a-zA-Z0-9-]{1,63}\.){1,8}[a-zA-Z]{2,63}$/;
  return emailPattern.test(val) || 'Email inválido';
}

export function formatDocument(val){
  if(val.length < 14){
    return val.substr(0,3)
            + '.' + val.substr(3,3)
            + '.' + val.substr(6,3)
            +'-'  + val.substr(9,2)
  }else{
    return val.substr(0,2)
            + '.' + val.substr(2,3)
            + '.' + val.substr(5,3)
            + '/' + val.substr(8,4)
            + '-' + val.substr(12,2)
  }
}
