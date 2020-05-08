function carregaCidade(idcidade, nome, nomeuf, lat, lon, idadm, telefone, email, facebook, instagram, twitter){
  //carregaCidade('<?= $j["id"] ?>', '<?= $j["nome"] ?>', '<?= $j["nomeuf"] ?>', '<?= $j["lat"] ?>', '<?= $j["lon"] ?>', '<?= $j["idadm"] ?>')
  $('#acao').val(idcidade);
  $('#nome').val(nome);
  $('#nomeuf').val(nomeuf);
  $('#lat').val(lat);
  $('#lon').val(lon);
  $('#idadm').val(idadm);
  $('#telefone').val(telefone);
  $('#email').val(email);
  $('#facebook').val(facebook);
  $('#instagram').val(instagram);
  $('#twitter').val(twitter);
}