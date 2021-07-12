function isInternetChanel(jsonObject) {
    var obj = JSON.parse(jsonObject);
    var internetOpCodes = [202, 203, 204, 205, 206, 207, 209, 210, 211, 220, 213, 214, 217, 245, 249, 241, 242, 221, 201, 230, 219, 222, 231, 223, 224, 227, 8208];
    var bankIdExcept = [2, 24, 9, 15, 13];
    if (obj.am >= 2000000)
        return true;
    if (obj.hi == 5 && obj.op == 211 && obj.am * 1.09 >= 2000000)
        return true;
    if (obj.am >= 75000 && (obj.op == 206 || obj.op == 207 || obj.op == 210))
        return true;
    for (i = 0; i < internetOpCodes.length; i++)
        if (internetOpCodes[i] == obj.op)
            return true;
    if (obj.am < 50000)
        for (i = 0; i < bankIdExcept.length; i++)
            if (bankIdExcept[i] == obj.bnk)
                return true;
    if (obj.am < 100000)
        if (9 == obj.bnk)
            return true;
    if (15 == obj.bnk)
        return true;
    return false;
} /*-----*/
function getPinMinLen(a) {
    var b = JSON.parse(a);
    if (17 == b.bnk) return 4;
    else return 5;
} /*-----*/
function getWalletEnabled(r) {
    var e = JSON.parse(r),
        n = [202, 203, 204, 205, 211, 219, 222, 223, 227, 221, 209];
    for (i = 0; i < n.length; i++)
        if (n[i] == e.op) return !0;
    return !1;
} /*-----*/
function getPaymentConfig(a) {
    var internetChannelResult = isInternetChanel(a);
    var pinMinLenResult = getPinMinLen(a);
    var walletEnabledResult = getWalletEnabled(a);
    var apsanCreditEnabledResult = getApsanCreditEnabled(a);
    var defaultPaymentMethod = getDefaultPaymentMethod(a);
    var directDebitEnabledResult = getDirectDebitEnabled(a);
    var directDebitBalanceShowEnabledResult = getDirectDebitBalanceShowEnabled(a);
    var dynamicPinActiveResult = getDynamicPinActive(a);
    var dynamicPinEnabledResult = getDynamicPinEnabled(a);
    var apOtpActiveResult = getApOtpActive(a);
    var cardEnabledResult = getCardEnabled(a);
    var getMinAmountResult = getMinAmount(a);
    return JSON.stringify({
        "isInternetChanel": internetChannelResult,
        "getPinMinLen": pinMinLenResult,
        "getWalletEnabled": walletEnabledResult,
        "getApsanCreditEnabled": apsanCreditEnabledResult,
        "getDefaultPaymentMethod": defaultPaymentMethod,
        "getDirectDebitEnabled": directDebitEnabledResult,
        "getDirectDebitBalanceShowEnabled": directDebitBalanceShowEnabledResult,
        "getDynamicPinActive": dynamicPinActiveResult,
        "getDynamicPinEnabled": dynamicPinEnabledResult,
        "getApOtpActive": apOtpActiveResult,
        "getCardEnabled": cardEnabledResult,
        "getMinAmount": getMinAmountResult
    });
} /*-----*/
function getApsanCreditEnabled(r) {
    var e = JSON.parse(r),
        n = [209, 221, 222, 223, 227, 202, 203, 205, 204, 219, 211];
    for (i = 0; i < n.length; i++)
        if (n[i] == e.op && e.cst) return !0;
    return !1;
} /*-----*/
function getDefaultPaymentMethod(r) {
    var none = 0;
    var wallet = 1;
    var card = 2;
    var credit = 3;
    return card;
} /*-----*/
function getDynamicPinActive(a) {
    return true;
} /*-----*/
function getDynamicPinEnabled(a) {
    return true;
} /*-----*/
function getOTPFromSMS(a) {
    var otpResult = "";
    return otpResult;
} /*-----*/
function getApOtpActive(a) {
    return false;
} /*-----*/
function getCardEnabled(r) {
    return true;
} /*-----*/
function getDirectDebitEnabled(r) {
    return false;
} /*-----*/
function getDirectDebitBalanceShowEnabled(r) {
    return false;
} /*-----*/
function getMinAmount(r) {
    var e = JSON.parse(r),
        n = [202, 203, 204, 205, 207, 210, 211, 219],
        bnkIdList1 = [19, 11, 15, 24, 39, 32, 35, 13, 5, 47, 2],
        bnkIdList2 = [9];
    if (n.includes(e.op)) {
        if (bnkIdList1.includes(e.bnk)) {
            return 50000;
        } else if (bnkIdList2.includes(e.bnk)) {
            return 100000;
        } else {
            return -1;
        }
    } else {
        return -1;
    }
}
