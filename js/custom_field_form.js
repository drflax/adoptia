customfield_text = 1;
customfield_textarea = 2;
customfield_bool = 3;
customfield_selection = 4;
customfield_separator = 5;
customfield_multipleselection = 6;
customfield_checkbox = 7;
customfield_picture = 8;
customfield_url = 9;
customfield_media = 10;
customfield_date = 11;

customfield_alnum = 1;
customfield_integer = 2;
customfield_float = 3;

customfield_normal = 0;
customfield_topright = 1;
customfield_bottomright = 2;

$(function() {
  var allConditionalFields = new Array(
    'subType', 'values', 'default_text', 'default_bool', 'default_multiple', 
    'mandatory', 'allowHtml', 'dateDefaultNow', 'fromyear', 'toyear', 
    'showInList', 'innewline', 'rowspan', 'sortable', 'mainPicture', 
    'searchable', 'rangeSearch', 'format', 'seo', 'showInForm', 'expl',
    'displayLabel', 'detailsPosition', 'formatSection', 'precision', 'precisionSeparator', 
    'thousandsSeparator', 'formatPrefix', 'formatPostfix', 'useMarkitup', 
    'formProperties', 'formatSection', 'listProperties', 'miscProperties', 'checkboxCols'
  );
  var allConditionFields = new Array(
    'userField', 'type', 'subType', 'showInList', 'showInForm', 'showInDetails', 'innewline', 'rowspan', 'searchable', 'detailsPosition', 'allowHtml'
  );
  //dump(cfForm);
  disableFields( allConditionalFields );
  hideAndDisplay();
  addConditionalEvents( allConditionFields );
});

function hideAndDisplay()
{
  var form = $('#gorumForm');
  var formVals = form.formHash();
  if( typeof formVals.showInList == 'undefined' ) formVals.showInList=0;
  if( typeof formVals.showInDetails == 'undefined' ) formVals.showInDetails=0;
  if( typeof formVals.showInForm == 'undefined' ) formVals.showInForm=0;
  if( typeof formVals.userField == 'undefined' ) formVals.userField=0;
  displayField( 'showInForm', (formVals.userField==0));
  displayField( 'type', (formVals.userField==0 && formVals.showInForm!=0));
  displayField( 'expl', (
    formVals.userField==0 &&
    formVals.type!=customfield_separator &&
    formVals.showInForm!=0
  ));
  displayField( 'displayLabel', (
    formVals.type!=customfield_separator &&
    formVals.type!=customfield_picture &&
    formVals.detailsPosition==customfield_normal &&
    formVals.showInDetails!=0
  ));
  displayField( 'detailsPosition', (
    formVals.type!=customfield_separator &&
    formVals.type!=customfield_picture &&
    formVals.showInDetails!=0
  ));
  displayField( 'subType', (formVals.userField==0 && formVals.type==customfield_text) );
  displayField( 'values', (
    formVals.userField==0 && (
    formVals.type==customfield_selection || 
    formVals.type==customfield_multipleselection || 
    formVals.type==customfield_checkbox )
  ));
  displayField( 'default_text', (
    formVals.userField==0 && (
    formVals.type==customfield_text || 
    formVals.type==customfield_selection )
  ));
  displayField( 'default_bool', (formVals.userField==0 && formVals.type==customfield_bool) );
  displayField( 'default_multiple', (
    formVals.userField==0 && (
    formVals.type==customfield_multipleselection || 
    formVals.type==customfield_checkbox || 
    formVals.type==customfield_textarea )
  ));
  displayField( 'mandatory', (formVals.userField==0 && formVals.type!=customfield_separator));
  displayField( 'allowHtml', (
    formVals.userField==0 && (
    formVals.type==customfield_text || 
    formVals.type==customfield_textarea )
  ));
  displayField( 'dateDefaultNow', (formVals.type==customfield_date));
  displayField( 'fromyear', (formVals.type==customfield_date));
  displayField( 'toyear', (formVals.type==customfield_date));
  displayField( 'showInList', (formVals.type!=customfield_separator));
  displayField( 'innewline', (
    formVals.type==customfield_textarea &&
    formVals.rowspan==0 &&
    formVals.showInList!=0
  ));
  displayField( 'rowspan', (
    formVals.innewline==0 &&
    formVals.showInList!=0 &&
    formVals.type!=customfield_separator &&
    formVals.type!=customfield_picture
  ));
  displayField( 'displaylength', (
    (formVals.type==customfield_text || 
    formVals.type==customfield_textarea) &&
    formVals.showInList!=0
  ));
  displayField( 'sortable', (
    (formVals.type==customfield_text || 
    formVals.type==customfield_bool || 
    formVals.type==customfield_selection || 
    formVals.type==customfield_multipleselection || 
    formVals.type==customfield_checkbox || 
    formVals.type==customfield_date) &&
    formVals.showInList!=0
  ));
  displayField( 'mainPicture', (
    formVals.type==customfield_picture &&
    formVals.showInList!=0
  ));
  displayField( 'mainPicture', (
    formVals.type==customfield_picture &&
    formVals.showInList!=0
  ));
  displayField( 'searchable', (
    formVals.type!=customfield_separator && 
    formVals.type!=customfield_url 
  ));
  displayField( 'rangeSearch', (
    (formVals.subType==customfield_integer ||
    formVals.subType==customfield_float ||
    formVals.type==customfield_date) &&
    formVals.searchable!=0
  ));
  displayField( 'format', (formVals.userField==0 && formVals.type==customfield_text) );
  displayField( 'checkboxCols', (formVals.userField==0 && formVals.type==customfield_checkbox) );
  displayField( 'formatSection', (formVals.userField==0 && formVals.type==customfield_text) );
  displayField( 'precision', (formVals.userField==0 && formVals.subType==customfield_float) );
  displayField( 'precisionSeparator', (formVals.userField==0 && formVals.subType==customfield_float) );
  displayField( 'thousandsSeparator', (formVals.subType==customfield_integer ||
                                       formVals.subType==customfield_float) );
  displayField( 'formatPrefix', (formVals.userField==0 && formVals.type==customfield_text) );
  displayField( 'formatPostfix', (formVals.userField==0 && formVals.type==customfield_text) );
  displayField( 'seo', (
    formVals.userField==0 && (
    formVals.type==customfield_text || 
    formVals.type==customfield_textarea )
  )); 
  displayField( 'useMarkitup', (
    formVals.type==customfield_textarea && formVals.allowHtml==1
  ));
  displayField( 'formProperties', (formVals.userField==0 && formVals.type!=customfield_separator));
  displayField( 'listProperties', (formVals.type!=customfield_separator));
  displayField( 'miscProperties', (formVals.type!=customfield_separator) && 
                                  (formVals.type!=customfield_picture) && 
                                  (formVals.type!=customfield_media) && 
                                  (formVals.type!=customfield_url));
}

function displayField( field, condition )
{
  var row = $("#gorumForm [name='"+field+"']").parents('tr.row');
  if( condition ) row.show();
  else row.hide();
}

function disableFields( fields )
{
  $.each( fields, function() {
    $("#" + this).parents('tr.row').hide();     
  });
}

function addConditionalEvents( fields )
{
  $.each( fields, function() {
    $("#gorumForm select[name='"+this+"']").change(hideAndDisplay);  
  });
  $.each( fields, function() {
    $("#gorumForm input[name='"+this+"']").click(hideAndDisplay);  
  });
}
