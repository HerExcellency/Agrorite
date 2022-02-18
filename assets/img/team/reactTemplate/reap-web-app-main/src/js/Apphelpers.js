const Apphelpers = {}
Apphelpers.url = {}
// const baseUrl = 'http://localhost/reaprite/api/web'
// const baseUrl = 'http://localhost/reaprite/api/v2'
// const baseUrl = 'https://api.reaprite.com/api/v2'
const baseUrl = 'https://api.reaprite.com/api/web'
Apphelpers.url.Login = `${baseUrl}/login`
Apphelpers.url.confirmLogin = `${baseUrl}/login/confirmLogin`
Apphelpers.url.getHistory = `${baseUrl}/history`
Apphelpers.url.getAllHistory = `${baseUrl}/history/getAllHistory`
Apphelpers.url.Register = `${baseUrl}/register`
Apphelpers.url.Reset = `${baseUrl}/login/resetpassword`
Apphelpers.url.Reset2 = `${baseUrl}/login/verifyCode`
Apphelpers.url.ConfirmAccount = `${baseUrl}/register/confirm`
Apphelpers.url.Newpassword = `${baseUrl}/reset`
Apphelpers.url.userWallet = `${baseUrl}/myaccount/wallet2`
Apphelpers.url.redeemInterest = `${baseUrl}/savings/redeeminterest`
Apphelpers.url.updateAccount = `${baseUrl}/myaccount/updateAccount`
Apphelpers.url.updatePassword = `${baseUrl}/myaccount/updatePassword`
Apphelpers.url.nextOfKin = `${baseUrl}/myaccount/nextOfKin`
Apphelpers.url.addAccountNumber = `${baseUrl}/myaccount/addAccountNumber`
Apphelpers.url.addbvn2 = `${baseUrl}/myaccount/addbvn`
Apphelpers.url.withdrawfromwallet = `${baseUrl}/savings/withdrawfromwallet`
Apphelpers.url.SingleInvestment = `${baseUrl}/investments/singleInvestment`
Apphelpers.url.UserInvestment = `${baseUrl}/investments/myInvestment`
Apphelpers.url.UserPaidInvestment = `${baseUrl}/investments/myPaidInvestment`
Apphelpers.url.UserSingleInvestment = `${baseUrl}/investments/mySingleInvestment`
Apphelpers.url.StartInvestment = `${baseUrl}/investments/startInvestment`
Apphelpers.url.AllInvestment = `${baseUrl}/investments`
Apphelpers.url.Usercards = `${baseUrl}/savings/cards`
Apphelpers.url.Removecards = `${baseUrl}/savings/removecard`
Apphelpers.url.Fundwallet = `${baseUrl}/savings`
Apphelpers.url.Offautodebit = `${baseUrl}/savings/offAutoDebit`

Apphelpers.url.Stopautodebitwallet = `${baseUrl}/savings/stopautodebitwallet`
Apphelpers.url.Previoussavings = `${baseUrl}/savings/previoussavings`
Apphelpers.url.OldSavings = `${baseUrl}/savings/oldsavings`
Apphelpers.url.currentSavings = `${baseUrl}/savings/activeoldsavings`
Apphelpers.url.referalBonus = `${baseUrl}/savings/getPendingReferal`
Apphelpers.url.getPaidReferal = `${baseUrl}/savings/getPaidReferal`
Apphelpers.url.getMyreferrals = `${baseUrl}/savings/getMyreferrals`
Apphelpers.url.signupBonus = `${baseUrl}/savings/getMySignupBonus`
Apphelpers.url.ProcessBonus = `${baseUrl}/savings/redeembonus`
// Apphelpers.url.ProcessBonus = `${baseUrl}/savings/redeembonus`
// Apphelpers.url.ProcessSignupBonus = `${baseUrl}/savings/redeemsignupbonus`

Apphelpers.url.StartReapquick = `${baseUrl}/savings/reapquick`
Apphelpers.url.StartReapplus = `${baseUrl}/savings/reapplus`
Apphelpers.url.StartReapmax = `${baseUrl}/savings/reapmax`
Apphelpers.url.SingleSavings = `${baseUrl}/history/singleHistory`
Apphelpers.url.Breaksave = `${baseUrl}/savings/breaksavings`
Apphelpers.url.Topupsave = `${baseUrl}/savings/topupsave`

Apphelpers.url.getBanks = `${baseUrl}/login/getbank`
//for reap goal target
Apphelpers.url.getTarget = `${baseUrl}/goals/getTarget`
Apphelpers.url.createTarget = `${baseUrl}/goals/createTarget`
Apphelpers.url.SingleTargetSavings = `${baseUrl}/goals/getSingleTarget`
Apphelpers.url.Breaktargetsave = `${baseUrl}/goals/breakTarget`
Apphelpers.url.Topuptargetsave = `${baseUrl}/goals/targetTopUp`
Apphelpers.url.Autotargetsave = `${baseUrl}/goals/targetAutoTopUp`
Apphelpers.url.OffGoalAutodebit = `${baseUrl}/goals/offAutoDebit`
Apphelpers.url.Userclosedtarget = `${baseUrl}/goals/getClosedTarget`
Apphelpers.url.OnGoalAutodebit = `${baseUrl}/goals/onAutoDebit`
Apphelpers.url.TargetPaymentSetting = `${baseUrl}/goals/targetPaymentSetting`

//for reap goal village
Apphelpers.url.GetUserVillage = `${baseUrl}/goals/getUserVillages`
Apphelpers.url.GetUserClosedVillage = `${baseUrl}/goals/getUserClosedVillages`
Apphelpers.url.getVillage = `${baseUrl}/goals/getVillage`
Apphelpers.url.createVillage = `${baseUrl}/goals/createVillage`
Apphelpers.url.SingleVillageSavings = `${baseUrl}/goals/getSingleVillage`
Apphelpers.url.Breakvillagesave = `${baseUrl}/goals/breakVillage`
Apphelpers.url.Topupvillagesave = `${baseUrl}/goals/villageTopUp`
Apphelpers.url.Autovillagesave = `${baseUrl}/goals/villageAutoTopUp`
Apphelpers.url.makeChief = `${baseUrl}/goals/makeChief`
Apphelpers.url.updateVillage = `${baseUrl}/goals/updateVillage`
Apphelpers.url.joinVillage = `${baseUrl}/goals/joinVillage`
Apphelpers.url.VillagePaymentSetting = `${baseUrl}/goals/villagePaymentSetting`




// AJAX for sending request
Apphelpers.sendRequest = (Obj, callback) => {
    if (!Obj instanceof Object) return
    if (Obj.url === undefined) return
    fetch(Obj.url, Obj).then(res => res.json().then(data => callback(data)))
        .catch((err) => callback({ "error": "Could not connect to the server" }))

}

Apphelpers.greeting = () => {
    let myDate = new Date();
    var title = ''
    if (myDate.getHours() < 12) {
        title = "Good Morning, ";
    }
    else if (myDate.getHours() >= 12 && myDate.getHours() <= 17) {
        title = "Good Afternoon, ";
    }
    else if (myDate.getHours() > 17 && myDate.getHours() <= 24) {
        title = "Good Evening, ";
    }
    else {
        title = "Good Night ";
    }
    return title
}

export default Apphelpers