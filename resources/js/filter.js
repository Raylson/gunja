Vue.filter('capitalize', function (value) {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
})

Vue.filter('splitAndCapitalize', function (value) {
    if (!value) return ''
    value = value.toString()
    var temp = value.split("-")
    return temp[0].charAt(0).toUpperCase() + temp[0].slice(1) + ' ' + temp[1].charAt(0).toUpperCase() + temp[1].slice(1)
})

Vue.filter('slug', function (value) {
    if (!value) return ''
    //value = value.toString()
    return value
        .toLowerCase()
        .replace(/[^\w ]+/g,'')
        .replace(/ +/g,'-');
})

//Vue moment js to show human readable date
import moment from "moment"; //Import Moment

Vue.filter("formatDate", function(date) {
	return moment(date).format('MMMM Do YYYY');
});

Vue.filter("formatDateFull", function(date) {
	return moment(date).format('yyyy-MM-DD HH:mm:ss');
});

Vue.filter("capitalFirstletter", function(value, symbol = '_') {
    let newVal = value.replaceAll(symbol, " ");
    return newVal.toLowerCase().split(' ').map(s => s.charAt(0).toUpperCase() + s.substring(1)).join(' ');
});

Vue.filter('standardNumber', function (value) {
    if(value < 10)
        return '0'+value;
    else
        return value;
})

Vue.filter('combineUserName', function (value, middle_name, last_name) {
    return value+(middle_name !=null ? ' '+middle_name : '')+(last_name !=null ? ' '+last_name : '');
})