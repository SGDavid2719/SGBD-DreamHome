function PostPropertyData(pData) {
  var lCleanBuffer = "<?php echo ob_clean(); ?>";
  var lData;
  $.ajax({
    type: "POST",
    url: "http://localhost:8000/VIEWS/PROPERTY/All_QueryProperty.php",
    data: { propertyno: pData },
    async: false,
    success: function (lResult) {
      lData = lResult;
    },
  });
  return lData;
}
