function isInternetChanel(jsonObject) {
    var e = JSON.parse(jsonObject),
        n = [270, 8000];
    for (i = 0; i < n.length; i++)
        if (n[i] == e.op) return !0;
    return !1;
} /*-----*/
function getPinMinLen(jsonObject) {
    return 5;
} /*-----*/
function getWalletEnabled(jsonObject) {
    var e = JSON.parse(jsonObject)
    var n = [239, 202, 203, 204, 205, 211, 219, 222, 223, 227, 221, 209, 8000];
    // if (e.op == 239 || (e.op == 209 && e.sop == 5)) {
    //     return false;
    // }
    for (i = 0; i < n.length; i++)
        if (n[i] == e.op) return !0;
    return !1;
} /*-----*/
function getPaymentConfig(jsonObject) {
    var internetChannelResult = isInternetChanel(jsonObject);
    var pinMinLenResult = getPinMinLen(jsonObject);
    var walletEnabledResult = getWalletEnabled(jsonObject);
    var apsanCreditEnabledResult = getApsanCreditEnabled(jsonObject);
    var defaultPaymentMethod = getDefaultPaymentMethod(jsonObject);
    var dynamicPinActiveResult = getDynamicPinActive(jsonObject);
    var dynamicPinEnabledResult = getDynamicPinEnabled(jsonObject);
    var apOtpActiveResult = getApOtpActive(jsonObject);
    var cardEnabledResult = getCardEnabled(jsonObject);
    var isCardHolderNameVisibleResult = isCardHolderNameVisible(jsonObject);
    var payLaterEnabledResult = getPayLaterEnabled(jsonObject);
    return JSON.stringify({
        "isInternetChanel": internetChannelResult,
        "getPinMinLen": pinMinLenResult,
        "getWalletEnabled": walletEnabledResult,
        "getApsanCreditEnabled": apsanCreditEnabledResult,
        "getDefaultPaymentMethod": defaultPaymentMethod,
        "getDynamicPinActive": dynamicPinActiveResult,
        "getDynamicPinEnabled": dynamicPinEnabledResult,
        "getApOtpActive": apOtpActiveResult,
        "getCardEnabled": cardEnabledResult,
        "isCardHolderNameVisible": isCardHolderNameVisibleResult,
        "getPayLaterEnabled": payLaterEnabledResult
    });
} /*-----*/
function getApsanCreditEnabled(jsonObject) {
    return false;
} /*-----*/
function getDefaultPaymentMethod(jsonObject) {
    var none = 0;
    var wallet = 1;
    var card = 2;
    return card;
} /*-----*/
function getDynamicPinActive(jsonObject) {
    return false;
} /*-----*/
function getDynamicPinEnabled(jsonObject) {
    return false;
} /*-----*/
function getOTPFromSMS(jsonObject) {
    var otpResult = "";
    return otpResult;
} /*-----*/
function getApOtpActive(jsonObject) {
    return true;
} /*-----*/
function getCardEnabled(jsonObject) {
    var e = JSON.parse(jsonObject);
    if (e.op == 239 && e.cfw == true){
        return false
    }
    return true;
} /*-----*/
function isCardHolderNameVisible(jsonObject) {
    var e = JSON.parse(jsonObject),
        n = [270];
    for (i = 0; i < n.length; i++)
        if (n[i] == e.op) return !0;
    return !1;
} /*-----*/
function getPayLaterEnabled(jsonObject) {
    var e = JSON.parse(jsonObject);
    if (e.am < 1000) {
        return false;
    }
    for (i = 0; i < n.length; i++)
        if (n[i] == e.op) return !0;
    return false;
}
