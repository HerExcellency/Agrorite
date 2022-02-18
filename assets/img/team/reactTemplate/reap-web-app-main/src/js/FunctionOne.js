// import { Autodebitoff } from '../pages/Components'
import Apphelpers from './Apphelpers'
import Apphistory from './Context/Apphistory'
import ReducerAction from './Context/ReducerAction'
import { appState, dispatcher } from './Context/State'

const FunctionOne = {}

//today's date
FunctionOne.todayDate = () => {
    let today = new Date();
    let dd = today.getDate();
    let mm = today.getMonth() + 1;
    let yyyy = today.getFullYear();
    let todayDate = `${dd}-${mm}-${yyyy}`;
    return todayDate
}
//goal savings starts here
FunctionOne.getTarget = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.getTarget,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {

        appState.result.previoustargets = res
        FunctionOne.updateAppState()
    })
}

FunctionOne.singleTargetSavings = (id) => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    let savingsId = id

    let formData = new FormData()
    formData.append('token', token)
    formData.append('goal_id', savingsId)
    let sendData = {
        url: Apphelpers.url.SingleTargetSavings,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        if (res.status === 'error') {
            Apphistory.push('/savings/reapgoal/target')

            FunctionOne.updateAppState()
        }
        appState.result.singletargetsavings = res
        // console.log(res)
        // console.log(res.message)
        FunctionOne.updateAppState()
    })
}

FunctionOne.Breaktargetsave = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    // let { amount, breakid, planid } = e.target.elements
    let amount = document.querySelector('.amount')
    let breakid = document.querySelector('.breakid')
    amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    // console.log(amount)
    amount = parseInt(amount)
    // console.log(amount)
    // return
    breakid = breakid && breakid.value.trim()

    let modalContent = {
        title: 'Break Savings',
        message: "Breaking of Target savings will close this plan and also the interest accrued will be forfeited. Your capital will be returned to your wallet",
        callToAction: 'Do you want to continue?',
        amount: amount

    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAutoTarget = () => {

        let formData = new FormData()
        formData.append('token', token)
        formData.append('savings_id', breakid)
        let sendData = {
            url: Apphelpers.url.Breaktargetsave,
            method: 'POST',
            body: formData
        }
        appState.loader = true
        document.querySelector('.btnDisabled').disabled = true;
        FunctionOne.updateAppState()
        Apphelpers.sendRequest(sendData, res => {
            document.querySelector('.btnDisabled').disabled = false;
            appState.loader = false
            if (res.status === 'success') {
                FunctionOne.flash("success", res.message)
                setTimeout(() => {
                    window.location.reload()
                }, 4000)
            } else {

                return FunctionOne.flash("error", res.message)
            }

        })
    }
}
//section to create reap target
FunctionOne.RegisterReaptarget = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let bvn = appState.userDetails.user_bvn
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }

    // let { amount, auto, frequency, target, duration, payment } = e.target.elements
    let targetDate = document.querySelector('.startDate')
    let endDate = document.querySelector('.endDate')
    let targetTitle = document.querySelector('.targetTitle')
    let target = document.querySelector('.targetAmount')
    let amount = document.querySelector('.amount')
    let auto1 = document.querySelector('.auto')
    let auth = document.querySelector('.mPayment')
    let payment = auth.selectedOptions[0].value
    let frequency1 = document.querySelector('.frequency')
    let frequency = frequency1.selectedOptions[0].value
    let auto = auto1.selectedOptions[0].value
    amount = amount && amount.value.trim()
    targetTitle = targetTitle && targetTitle.value.trim()
    targetDate = targetDate && targetDate.value.trim()
    endDate = endDate && endDate.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    amount = parseInt(amount)
    target = target && target.value.trim()
    target = target.replace(/\,/g, '')
    target = target.replace(/\₦/g, '')
    target = parseInt(target)
    let today = new Date();
    let dd = today.getDate();
    let mm = today.getMonth() + 1;
    let yyyy = today.getFullYear();
    let todayDate = `${yyyy}-${mm}-${dd}`;

    let authorization1 = auth.selectedOptions[0].getAttribute('data-authorization')
    // console.log(authorization1);

    if (bvn === false) {
        return FunctionOne.flash("error", "You need to update your bvn to be able to perform this task")
    }
    if (targetTitle === '' || targetTitle.length < 2) {
        return FunctionOne.flash("error", "Please give your target a title")
    }
    if (targetTitle.length > 30) {
        return FunctionOne.flash("error", "Target title should not be more than 30 characters long")
    }
    if (!target || target === '') {
        return FunctionOne.flash("error", "Please set a target you are saving towards")
    }
    if (targetDate === '') {
        return FunctionOne.flash("error", "Please set a date to start the target")
    }

    if (new Date(targetDate) < new Date(todayDate)) {
        return FunctionOne.flash("error", "Plan start date should be today or future date")
    }
    if (endDate === '') {
        return FunctionOne.flash("error", "Please set a date you want to end the target")
    }
    if (new Date(endDate) < new Date(targetDate)) {
        return FunctionOne.flash("error", "Maturity date should be greater than your start date")
    }
    if (!amount || amount === '') {
        return FunctionOne.flash("error", " Savings Amount is required")
    }
    if (amount < 500) {
        return FunctionOne.flash("error", "Minimum funding for Reap Target is ₦500")
    }

    let modalTitle = "Create Target Saving's plan";
    let message = "You are about to create a new target saving's plan"
    let modalContent = {
        title: modalTitle,
        message: message,
        planTitle: targetTitle,
        callToAction: 'Do you want to continue?',
        amount: amount,
        frequency: frequency === '1' ? 'Daily' : frequency === '7' ? 'Weekly' : frequency === '30' ? 'Monthly' : 'One time',
        payment: payment,
        howToSave: auto === '1' ? 'Auto' : 'Manual',
        target: target,
        startDate: targetDate,
        endDate: endDate,
        authur: authorization1 === null ? 'null' : authorization1
    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    // return
    // var duration = 1;
    FunctionOne.ProceedTargetSavings = () => {

        if (payment === 'wallet') {
            let formData = new FormData()
            formData.append('token', token)
            formData.append('plan_target', target)
            formData.append('saving_amount', amount)
            formData.append('auto_save', auto)
            formData.append('auto_save_duration', frequency)
            formData.append('payment_method', payment)
            formData.append('start_date', targetDate)
            formData.append('maturity_date', endDate)
            formData.append('goal_title', targetTitle)
            let sendData = {
                url: Apphelpers.url.createTarget,
                method: 'POST',
                body: formData
            }
            appState.loader = true
            appState.loader = ReducerAction.loader.Payment
            document.querySelector('.btnDisabled').disabled = true;
            FunctionOne.updateAppState()
            Apphelpers.sendRequest(sendData, res => {
                appState.loader = false
                document.querySelector('.btnDisabled').disabled = false;
                if (res.status === 'success') {
                    FunctionOne.flash("success", res.message)
                    setTimeout(() => {
                        window.location = '/savings/reapgoal/target'
                    }, 4000)
                } else {

                    return FunctionOne.flash("error", res.message)
                }

            })

        } else {
            let auth = document.querySelector('.mPayment')
            let authorization = auth.selectedOptions[0].getAttribute('data-authorization')
            if (authorization && authorization !== null) {
                let formData = new FormData()
                formData.append('token', token)
                formData.append('plan_target', target)
                formData.append('saving_amount', amount)
                formData.append('auto_save', auto)
                formData.append('auto_save_duration', frequency)
                formData.append('payment_method', payment)
                formData.append('start_date', targetDate)
                formData.append('maturity_date', endDate)
                formData.append('goal_title', targetTitle)
                formData.append('authorization', authorization)
                let sendData = {
                    url: Apphelpers.url.createTarget,
                    method: 'POST',
                    body: formData
                }
                appState.loader = true
                document.querySelector('.btnDisabled').disabled = true;
                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
                Apphelpers.sendRequest(sendData, res => {
                    appState.loader = false
                    document.querySelector('.btnDisabled').disabled = false;
                    if (res.status === 'success') {
                        FunctionOne.flash("success", res.message)
                        setTimeout(() => {
                            window.location = '/savings/reapgoal/target'
                        }, 4000)
                    } else {
                        return FunctionOne.flash("error", res.message)
                    }

                })
            } else {
                appState.payment.start = true
                document.querySelector('.btnDisabled').disabled = true;
                appState.payment.amount = amount
                appState.payment.auto = auto
                appState.payment.frequency = frequency
                appState.payment.targetTitle = targetTitle
                appState.payment.target = target
                appState.payment.payment = payment
                appState.payment.targetDate = targetDate
                appState.payment.endDate = endDate

                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
            }
        }
    }

}

FunctionOne.CompleteReapTargetPayment = (e) => {
    let token = appState.userDetails.token
    let amount = appState.payment.amount
    let auto = appState.payment.auto
    let targetDate = appState.payment.targetDate
    let targetTitle = appState.payment.targetTitle
    let frequency = appState.payment.frequency
    let endDate = appState.payment.endDate
    let target = appState.payment.target
    let payment = appState.payment.payment
    let reference = e.reference
    let status = e.status

    if (status !== "success") {
        return FunctionOne.flash("error", "Sorry this transaction was not successful")
    }

    let formData = new FormData()
    formData.append('token', token)
    formData.append('plan_target', target)
    formData.append('saving_amount', amount)
    formData.append('auto_save', auto)
    formData.append('auto_save_duration', frequency)
    formData.append('payment_method', payment)
    formData.append('start_date', targetDate)
    formData.append('maturity_date', endDate)
    formData.append('goal_title', targetTitle)
    formData.append('transaction_code', reference)
    formData.append('payment_method', 'paystack')
    formData.append('authorization', '')


    let sendData = {
        url: Apphelpers.url.createTarget,
        method: 'POST',
        body: formData
    }
    appState.payment.start = null
    document.querySelector('.btnDisabled').disabled = true;
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        document.querySelector('.btnDisabled').disabled = false;
        appState.loader = false
        if (res.status === 'success') {
            FunctionOne.getWallet()

            FunctionOne.flash("success", res.message)
            setTimeout(() => {
                window.location = '/savings/reapgoal/target'
            }, 4000)

        } else {

            return FunctionOne.flash("error", res.message)
        }

    })

}

//closed targets
FunctionOne.getUserClosedTarget = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.Userclosedtarget,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.allclosedtarget = res.message
        FunctionOne.updateAppState()
    })
}

//top up target
FunctionOne.Topuptargetsave = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    // let { amount, auto, frequency, payment, planid } = e.target.elements
    let title = document.querySelector('.targetTitle')
    let amount = document.querySelector('.amount')
    let planid = document.querySelector('.planid')
    let auth = document.querySelector('.mPayment')
    let payment = auth.selectedOptions[0].value
    amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    amount = parseInt(amount)
    planid = planid && planid.value
    title = title && title.value

    if (!amount || amount === '') {
        return FunctionOne.flash("error", " Topup Amount is required")
    }
    if (amount < 500) {
        return FunctionOne.flash("error", " Topup Minimum funding amount is ₦500")
    }

    let modalContent = {
        title: 'Target Savings topup',
        message: "You are about to topup your " + title + " plan",
        callToAction: 'Do you want to continue?',
        amount: amount,
        payment: payment

    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAuto2 = () => {

        if (payment === 'wallet') {
            let formData = new FormData()
            formData.append('token', token)
            formData.append('saving_amount', amount)
            formData.append('payment_method', payment)
            formData.append('goal_id', planid)
            let sendData = {
                url: Apphelpers.url.Topuptargetsave,
                method: 'POST',
                body: formData
            }
            appState.loader = true
            document.querySelector('.btnDisabled').disabled = true;
            appState.loader = ReducerAction.loader.Payment
            FunctionOne.updateAppState()
            Apphelpers.sendRequest(sendData, res => {
                document.querySelector('.btnDisabled').disabled = false;
                appState.loader = false
                if (res.status === 'success') {
                    FunctionOne.singleTargetSavings(planid)
                    return FunctionOne.flash("success", res.message)
                    // setTimeout(() => {
                    //     window.location.reload()
                    // }, 4000)
                } else {

                    return FunctionOne.flash("error", res.message)
                }

            })

        } else {
            // let auth = document.querySelector('.mPayment')
            let authorization = auth.selectedOptions[0].getAttribute('data-authorization')
            if (authorization && authorization !== null) {
                let formData = new FormData()
                formData.append('token', token)
                formData.append('saving_amount', amount)
                formData.append('payment_method', payment)
                formData.append('goal_id', planid)
                formData.append('authorization', authorization)
                let sendData = {
                    url: Apphelpers.url.Topuptargetsave,
                    method: 'POST',
                    body: formData
                }
                appState.loader = true
                document.querySelector('.btnDisabled').disabled = true;
                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
                Apphelpers.sendRequest(sendData, res => {
                    appState.loader = false
                    document.querySelector('.btnDisabled').disabled = false;
                    if (res.status === 'success') {
                        FunctionOne.singleTargetSavings(planid)
                        return FunctionOne.flash("success", res.message)
                        // setTimeout(() => {
                        //     window.location.reload()
                        // }, 4000)
                    } else {

                        return FunctionOne.flash("error", res.message)
                    }

                })
            } else {
                appState.payment.start = true
                appState.payment.amount = amount
                appState.payment.planid = planid
                appState.payment.payment = payment

                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
            }
        }
    }

}

FunctionOne.CompleteTopuptargetsave = (e) => {
    let token = appState.userDetails.token
    let amount = appState.payment.amount
    let planid = appState.payment.planid
    let reference = e.reference
    let status = e.status

    if (status !== "success") {
        return FunctionOne.flash("error", "Sorry this transaction was not successful")
    }

    let formData = new FormData()
    formData.append('token', token)
    formData.append('saving_amount', amount)
    formData.append('transaction_code', reference)
    formData.append('payment_method', 'paystack')
    formData.append('goal_id', planid)
    formData.append('authorization', '')


    let sendData = {
        url: Apphelpers.url.Topuptargetsave,
        method: 'POST',
        body: formData
    }
    appState.payment.start = null
    document.querySelector('.btnDisabled').disabled = true;
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        document.querySelector('.btnDisabled').disabled = false;
        if (res.status === 'success') {
            FunctionOne.singleTargetSavings(planid)
            return FunctionOne.flash("success", res.message)
            // setTimeout(() => {
            //     window.location = '/savings/reapquick'
            // }, 4000)

        } else {

            return FunctionOne.flash("error", res.message)
        }

    })

}
//set auto top up target(should be decommision)
FunctionOne.Autotargetsave = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    // let { amount, auto, frequency, payment, planid } = e.target.elements
    let title = document.querySelector('.targetTitle')
    let amount = document.querySelector('.amount')
    let planid = document.querySelector('.planid')
    let frequency1 = document.querySelector('.frequency')
    let frequency = frequency1.selectedOptions[0].value
    let auth = document.querySelector('.mPayment')
    let payment = auth.selectedOptions[0].value
    amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    amount = parseInt(amount)
    planid = planid && planid.value
    title = title && title.value

    if (!amount || amount === '') {
        return FunctionOne.flash("error", " Topup Amount is required")
    }
    if (amount < 500) {
        return FunctionOne.flash("error", " Topup Minimum funding amount is ₦500")
    }

    let modalContent = {
        title: 'Target Savings Auto topup settings',
        message: "You are about to set auto topup for your " + title + " plan",
        callToAction: 'Do you want to continue?',
        amount: amount,
        payment: payment,
        duration: frequency === '1' ? 'Daily' : frequency === '7' ? 'Weekly' : frequency === '30' ? 'Monthly' : 'One time',
        // payment: payment,

    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAuto = () => {

        if (payment === 'wallet') {
            let formData = new FormData()
            formData.append('token', token)
            formData.append('saving_amount', amount)
            formData.append('payment_method', payment)
            formData.append('goal_id', planid)
            formData.append('auto_save_duration', frequency)
            let sendData = {
                url: Apphelpers.url.Autotargetsave,
                method: 'POST',
                body: formData
            }
            appState.loader = true
            document.querySelector('.btnDisabled').disabled = true;
            appState.loader = ReducerAction.loader.Payment
            FunctionOne.updateAppState()
            Apphelpers.sendRequest(sendData, res => {
                document.querySelector('.btnDisabled').disabled = false;
                appState.loader = false
                if (res.status === 'success') {
                    FunctionOne.singleTargetSavings(planid)
                    return FunctionOne.flash("success", res.message)
                    // setTimeout(() => {
                    //     window.location.reload()
                    // }, 4000)
                } else {

                    return FunctionOne.flash("error", res.message)
                }

            })

        } else {
            // let auth = document.querySelector('.mPayment')
            let authorization = auth.selectedOptions[0].getAttribute('data-authorization')
            if (authorization && authorization !== null) {
                let formData = new FormData()
                formData.append('token', token)
                formData.append('saving_amount', amount)
                formData.append('payment_method', payment)
                formData.append('goal_id', planid)
                formData.append('auto_save_duration', frequency)
                formData.append('authorization', authorization)
                let sendData = {
                    url: Apphelpers.url.Autotargetsave,
                    method: 'POST',
                    body: formData
                }
                appState.loader = true
                document.querySelector('.btnDisabled').disabled = true;
                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
                Apphelpers.sendRequest(sendData, res => {
                    appState.loader = false
                    document.querySelector('.btnDisabled').disabled = false;
                    if (res.status === 'success') {
                        FunctionOne.singleTargetSavings(planid)
                        return FunctionOne.flash("success", res.message)
                        // setTimeout(() => {
                        //     window.location.reload()
                        // }, 4000)
                    } else {

                        return FunctionOne.flash("error", res.message)
                    }

                })
            } else {
                appState.payment.start = true
                appState.payment.amount = amount
                appState.payment.planid = planid
                appState.payment.payment = payment
                appState.payment.frequency = frequency

                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
            }
        }
    }

}

FunctionOne.CompleteAutotargetsave = (e) => {
    let token = appState.userDetails.token
    let amount = appState.payment.amount
    let planid = appState.payment.planid
    let frequency = appState.payment.frequency
    let reference = e.reference
    let status = e.status

    if (status !== "success") {
        return FunctionOne.flash("error", "Sorry this transaction was not successful")
    }

    let formData = new FormData()
    formData.append('token', token)
    formData.append('saving_amount', amount)
    formData.append('transaction_code', reference)
    formData.append('payment_method', 'paystack')
    formData.append('goal_id', planid)
    formData.append('auto_save_duration', frequency)
    formData.append('authorization', '')


    let sendData = {
        url: Apphelpers.url.Autotargetsave,
        method: 'POST',
        body: formData
    }
    appState.payment.start = null
    document.querySelector('.btnDisabled').disabled = true;
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        document.querySelector('.btnDisabled').disabled = false;
        if (res.status === 'success') {
            FunctionOne.singleTargetSavings(planid)
            return FunctionOne.flash("success", res.message)
            // setTimeout(() => {
            //     window.location = '/savings/reapquick'
            // }, 4000)

        } else {

            return FunctionOne.flash("error", res.message)
        }

    })

}
//decomissioning ends here

//village payment setting
FunctionOne.PaymentsettingTarget = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    // let { amount, auto, frequency, payment, planid } = e.target.elements
    let title = document.querySelector('.targetTitle')
    let amount = document.querySelector('.amount')
    let planid = document.querySelector('.planid')
    let auth = document.querySelector('.mPayment')
    let payment = auth.selectedOptions[0].value
    amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    amount = parseInt(amount)
    planid = planid && planid.value
    title = title && title.value
    let authorization1 = auth.selectedOptions[0].getAttribute('data-authorization')

    let modalContent = {
        title: 'Target Payment Setting',
        message: "You are about change the payment option for " + title + " plan",
        callToAction: 'Do you want to continue?',
        amount: amount,
        payment: payment,
        authur: authorization1 === null ? 'null' : authorization1

    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAuto2 = () => {

        if (payment === 'wallet') {
            let formData = new FormData()
            formData.append('token', token)
            formData.append('saving_amount', amount)
            formData.append('payment_method', payment)
            formData.append('goal_id', planid)
            let sendData = {
                url: Apphelpers.url.TargetPaymentSetting,
                method: 'POST',
                body: formData
            }
            appState.loader = true
            document.querySelector('.btnDisabled').disabled = true;
            appState.loader = ReducerAction.loader.Payment
            FunctionOne.updateAppState()
            Apphelpers.sendRequest(sendData, res => {
                document.querySelector('.btnDisabled').disabled = false;
                appState.loader = false
                if (res.status === 'success') {
                    // FunctionOne.singleVillageSavings(villageid)
                    FunctionOne.flash("success", res.message)
                    setTimeout(() => {
                        window.location.reload()
                    }, 4000)
                } else {

                    return FunctionOne.flash("error", res.message)
                }

            })

        } else {
            // let auth = document.querySelector('.mPayment')
            let authorization = auth.selectedOptions[0].getAttribute('data-authorization')
            if (authorization && authorization !== null) {
                let formData = new FormData()
                formData.append('token', token)
                formData.append('saving_amount', amount)
                formData.append('payment_method', payment)
                formData.append('goal_id', planid)
                formData.append('authorization', authorization)
                let sendData = {
                    url: Apphelpers.url.TargetPaymentSetting,
                    method: 'POST',
                    body: formData
                }
                appState.loader = true
                document.querySelector('.btnDisabled').disabled = true;
                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
                Apphelpers.sendRequest(sendData, res => {
                    appState.loader = false
                    document.querySelector('.btnDisabled').disabled = false;
                    if (res.status === 'success') {
                        // FunctionOne.singleVillageSavings(villageid)
                        FunctionOne.flash("success", res.message)
                        setTimeout(() => {
                            window.location.reload()
                        }, 4000)
                    } else {

                        return FunctionOne.flash("error", res.message)
                    }

                })
            } else {
                appState.payment.start = true
                appState.payment.amount = amount
                appState.payment.planid = planid
                appState.payment.payment = payment

                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
            }
        }
    }

}

FunctionOne.CompleteTargetPaymentSetting = (e) => {
    let token = appState.userDetails.token
    let amount = appState.payment.amount
    let planid = appState.payment.planid
    let reference = e.reference
    let status = e.status

    if (status !== "success") {
        return FunctionOne.flash("error", "Sorry this transaction was not successful")
    }

    let formData = new FormData()
    formData.append('token', token)
    formData.append('saving_amount', amount)
    formData.append('transaction_code', reference)
    formData.append('payment_method', 'paystack')
    formData.append('goal_id', planid)
    formData.append('authorization', '')


    let sendData = {
        url: Apphelpers.url.TargetPaymentSetting,
        method: 'POST',
        body: formData
    }
    appState.payment.start = null
    document.querySelector('.btnDisabled').disabled = true;
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        document.querySelector('.btnDisabled').disabled = false;
        if (res.status === 'success') {
            // FunctionOne.singleVillageSavings(villageid)
            FunctionOne.flash("success", res.message)
            setTimeout(() => {
                window.location.reload()
            }, 4000)

        } else {

            return FunctionOne.flash("error", res.message)
        }

    })

}





//off goal auto debit
FunctionOne.Offgoalautodebit = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let planid = document.querySelector('.planid')


    planid = planid && planid.value.trim()
    let modalContent = {
        title: 'Stop Auto debit for savings',
        message: 'You are about to stop Auto debit for this savings plan. If Auto debit is stopped, Reaprite will no longer have Authorization to debit your bank account on your behalf',
        callToAction: 'Do you want to continue?'

    }


    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAuto3 = () => {

        let formData = new FormData()
        formData.append('token', token)
        formData.append('savings_id', planid)
        // formData.append('mobile', mobile)
        let sendData = {
            url: Apphelpers.url.OffGoalAutodebit,
            method: 'POST',
            body: formData
        }
        appState.loader = true
        document.querySelector('.btnDisabled').disabled = true;
        FunctionOne.updateAppState()
        Apphelpers.sendRequest(sendData, res => {
            appState.loader = false
            if (res.status === 'success') {
                FunctionOne.flash("success", res.message)
                setTimeout(() => {
                    window.location.reload()
                }, 3000)

            } else {
                document.querySelector('.btnDisabled').disabled = false;
                return FunctionOne.flash("error", res.message)
            }

        })
    }
}
FunctionOne.Ongoalautodebit = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let planid = document.querySelector('.planid')


    planid = planid && planid.value.trim()
    let modalContent = {
        title: 'On Auto debit for savings',
        message: 'You are about to on Auto debit for this savings plan. If Auto debit is on, Reaprite will have Authorization to debit your account on your behalf',
        callToAction: 'Do you want to continue?'

    }


    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAuto3 = () => {

        let formData = new FormData()
        formData.append('token', token)
        formData.append('savings_id', planid)
        // formData.append('mobile', mobile)
        let sendData = {
            url: Apphelpers.url.OnGoalAutodebit,
            method: 'POST',
            body: formData
        }
        appState.loader = true
        document.querySelector('.btnDisabled').disabled = true;
        FunctionOne.updateAppState()
        Apphelpers.sendRequest(sendData, res => {
            appState.loader = false
            if (res.status === 'success') {
                FunctionOne.flash("success", res.message)
                setTimeout(() => {
                    window.location.reload()
                }, 3000)

            } else {
                document.querySelector('.btnDisabled').disabled = false;
                return FunctionOne.flash("error", res.message)
            }

        })
    }
}
/**
 * Village starts here
 */
FunctionOne.getAllVillages = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.getVillage,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {

        appState.result.allvillage = res.message
        // console.log(res)
        FunctionOne.updateAppState()
    })
}
//get user villages
FunctionOne.GetUserVillages = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.GetUserVillage,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.uservillage = res.message
        FunctionOne.updateAppState()
    })
}
//get user villages
FunctionOne.getUserClosedVillage = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.GetUserClosedVillage,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.userclosedvillage = res.message
        // console.log(res)
        FunctionOne.updateAppState()
    })
}

//create new village
FunctionOne.RegisterReapvillage = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let bvn = appState.userDetails.user_bvn
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }

    // let { amount, auto, frequency, target, duration, payment } = e.target.elements
    let targetDate = document.querySelector('.startDate')
    let endDate = document.querySelector('.endDate')
    let targetTitle = document.querySelector('.targetTitle')
    let target = document.querySelector('.targetAmount')
    let amount = document.querySelector('.amount')
    let agree = document.querySelector('.agree')
    let auto1 = document.querySelector('.auto')
    let auth = document.querySelector('.mPayment')
    let payment = auth.selectedOptions[0].value
    let frequency1 = document.querySelector('.frequency')
    let frequency = frequency1.selectedOptions[0].value
    let auto = auto1.selectedOptions[0].value
    amount = amount && amount.value.trim()
    targetTitle = targetTitle && targetTitle.value.trim()
    targetDate = targetDate && targetDate.value.trim()
    endDate = endDate && endDate.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    amount = parseInt(amount)
    target = target && target.value.trim()
    target = target.replace(/\,/g, '')
    target = target.replace(/\₦/g, '')
    target = parseInt(target)
    let today = new Date();
    let dd = today.getDate();
    let mm = today.getMonth() + 1;
    let yyyy = today.getFullYear();
    let todayDate = `${yyyy}-${mm}-${dd}`;

    agree = agree.checked


    let authorization1 = auth.selectedOptions[0].getAttribute('data-authorization')
    // console.log(authorization1);

    if (bvn === false) {
        return FunctionOne.flash("error", "You need to update your bvn to be able to perform this task")
    }
    if (targetTitle === '' || targetTitle.length < 2) {
        return FunctionOne.flash("error", "Please give your Village a name")
    }
    if (targetTitle.length > 30) {
        return FunctionOne.flash("error", "Village name should not be more than 30 characters long")
    }
    if (!target || target === '') {
        return FunctionOne.flash("error", "Please set a target the village is saving towards")
    }
    if (targetDate === '') {
        return FunctionOne.flash("error", "Please set a date to start the Village")
    }

    if (new Date(targetDate) < new Date(todayDate)) {
        return FunctionOne.flash("error", "Plan start date should be today or future date")
    }
    if (endDate === '') {
        return FunctionOne.flash("error", "Please set a date you want to end the Village")
    }
    if (new Date(endDate) < new Date(targetDate)) {
        return FunctionOne.flash("error", "Maturity date should be greater than your start date")
    }
    if (!amount || amount === '') {
        return FunctionOne.flash("error", " Savings Amount is required")
    }
    if (amount < 500) {
        return FunctionOne.flash("error", "Minimum funding for Reap Village is ₦500")
    }

    if (!agree) {

        return FunctionOne.flash("error", "Please agree to our terms and conditions")
    }

    let modalTitle = "Create Village Saving's plan";
    let message = "You are about to create a new Village saving's plan"
    let modalContent = {
        title: modalTitle,
        message: message,
        planTitle: targetTitle,
        callToAction: 'Do you want to continue?',
        amount: amount,
        frequency: frequency === '1' ? 'Daily' : frequency === '7' ? 'Weekly' : frequency === '30' ? 'Monthly' : 'One time',
        payment: payment,
        howToSave: auto === '1' ? 'Auto' : 'Manual',
        target: target,
        startDate: targetDate,
        endDate: endDate,
        authur: authorization1 === null ? 'null' : authorization1
    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    // return
    // var duration = 1;
    FunctionOne.ProceedTargetSavings = () => {

        if (payment === 'wallet') {
            let formData = new FormData()
            formData.append('token', token)
            formData.append('plan_target', target)
            formData.append('saving_amount', amount)
            formData.append('auto_save', auto)
            formData.append('auto_save_duration', frequency)
            formData.append('payment_method', payment)
            formData.append('start_date', targetDate)
            formData.append('maturity_date', endDate)
            formData.append('goal_title', targetTitle)
            let sendData = {
                url: Apphelpers.url.createVillage,
                method: 'POST',
                body: formData
            }
            appState.loader = true
            appState.loader = ReducerAction.loader.Payment
            document.querySelector('.btnDisabled').disabled = true;
            FunctionOne.updateAppState()
            Apphelpers.sendRequest(sendData, res => {
                appState.loader = false
                document.querySelector('.btnDisabled').disabled = false;
                if (res.status === 'success') {
                    FunctionOne.flash("success", res.message)
                    setTimeout(() => {
                        window.location = '/savings/reapgoal/village'
                    }, 4000)
                } else {

                    return FunctionOne.flash("error", res.message)
                }

            })

        } else {
            let auth = document.querySelector('.mPayment')
            let authorization = auth.selectedOptions[0].getAttribute('data-authorization')
            if (authorization && authorization !== null) {
                let formData = new FormData()
                formData.append('token', token)
                formData.append('plan_target', target)
                formData.append('saving_amount', amount)
                formData.append('auto_save', auto)
                formData.append('auto_save_duration', frequency)
                formData.append('payment_method', payment)
                formData.append('start_date', targetDate)
                formData.append('maturity_date', endDate)
                formData.append('goal_title', targetTitle)
                formData.append('authorization', authorization)
                let sendData = {
                    url: Apphelpers.url.createVillage,
                    method: 'POST',
                    body: formData
                }
                appState.loader = true
                document.querySelector('.btnDisabled').disabled = true;
                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
                Apphelpers.sendRequest(sendData, res => {
                    appState.loader = false
                    document.querySelector('.btnDisabled').disabled = false;
                    if (res.status === 'success') {
                        FunctionOne.flash("success", res.message)
                        setTimeout(() => {
                            window.location = '/savings/reapgoal/village'
                        }, 4000)
                    } else {
                        return FunctionOne.flash("error", res.message)
                    }

                })
            } else {
                appState.payment.start = true
                document.querySelector('.btnDisabled').disabled = true;
                appState.payment.amount = amount
                appState.payment.auto = auto
                appState.payment.frequency = frequency
                appState.payment.targetTitle = targetTitle
                appState.payment.target = target
                appState.payment.payment = payment
                appState.payment.targetDate = targetDate
                appState.payment.endDate = endDate

                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
            }
        }
    }

}

FunctionOne.CompleteReapVillagePayment = (e) => {
    let token = appState.userDetails.token
    let amount = appState.payment.amount
    let auto = appState.payment.auto
    let targetDate = appState.payment.targetDate
    let targetTitle = appState.payment.targetTitle
    let frequency = appState.payment.frequency
    let endDate = appState.payment.endDate
    let target = appState.payment.target
    let payment = appState.payment.payment
    let reference = e.reference
    let status = e.status

    if (status !== "success") {
        return FunctionOne.flash("error", "Sorry this transaction was not successful")
    }

    let formData = new FormData()
    formData.append('token', token)
    formData.append('plan_target', target)
    formData.append('saving_amount', amount)
    formData.append('auto_save', auto)
    formData.append('auto_save_duration', frequency)
    formData.append('payment_method', payment)
    formData.append('start_date', targetDate)
    formData.append('maturity_date', endDate)
    formData.append('goal_title', targetTitle)
    formData.append('transaction_code', reference)
    formData.append('payment_method', 'paystack')
    formData.append('authorization', '')


    let sendData = {
        url: Apphelpers.url.createVillage,
        method: 'POST',
        body: formData
    }
    appState.payment.start = null
    document.querySelector('.btnDisabled').disabled = true;
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        document.querySelector('.btnDisabled').disabled = false;
        appState.loader = false
        if (res.status === 'success') {
            FunctionOne.getWallet()

            FunctionOne.flash("success", res.message)
            setTimeout(() => {
                window.location = '/savings/reapgoal/village'
            }, 4000)

        } else {

            return FunctionOne.flash("error", res.message)
        }

    })

}

FunctionOne.singleVillageSavings = (id) => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    let savingsId = id

    let formData = new FormData()
    formData.append('token', token)
    formData.append('village_id', savingsId)
    let sendData = {
        url: Apphelpers.url.SingleVillageSavings,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        if (res.status === 'error') {
            Apphistory.push('/savings/reapgoal/village')
            FunctionOne.updateAppState()
        }
        appState.result.singlevillagesavings = res
        FunctionOne.updateAppState()
    })
}


//join village
FunctionOne.JoinReapvillage = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let bvn = appState.userDetails.user_bvn
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }

    // let { amount, auto, frequency, target, duration, payment } = e.target.elements

    let targetTitle = document.querySelector('.targetTitle')
    let villageId = document.querySelector('.villageId')
    let amount = document.querySelector('.amount')
    let target = document.querySelector('.targetAmount')
    let auth = document.querySelector('.mPayment')
    let payment = auth.selectedOptions[0].value
    let frequency1 = document.querySelector('.frequency')
    let frequency = frequency1.selectedOptions[0].value
    amount = amount && amount.value.trim()
    villageId = villageId && villageId.value.trim()
    targetTitle = targetTitle && targetTitle.value.trim()

    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    amount = parseInt(amount)
    target = target && target.value.trim()
    target = target.replace(/\,/g, '')
    target = target.replace(/\₦/g, '')
    target = parseInt(target)


    let authorization1 = auth.selectedOptions[0].getAttribute('data-authorization')
    // console.log(authorization1);

    if (bvn === false) {
        return FunctionOne.flash("error", "You need to update your bvn to be able to perform this task")
    }

    let modalTitle = "Joining Reap Village";
    let message = "You are about to join this Reap Village"
    let modalContent = {
        title: modalTitle,
        message: message,
        planTitle: targetTitle,
        callToAction: 'Do you want to continue?',
        amount: amount,
        frequency: frequency === '1' ? 'Daily' : frequency === '7' ? 'Weekly' : frequency === '30' ? 'Monthly' : 'One time',
        payment: payment,
        target: target,
        authur: authorization1 === null ? 'null' : authorization1
    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    // return
    // var duration = 1;
    FunctionOne.ProceedTargetSavings = () => {

        if (payment === 'wallet') {
            let formData = new FormData()
            formData.append('token', token)
            formData.append('village_id', villageId)
            formData.append('payment_method', payment)
            let sendData = {
                url: Apphelpers.url.joinVillage,
                method: 'POST',
                body: formData
            }
            appState.loader = true
            appState.loader = ReducerAction.loader.Payment
            document.querySelector('.btnDisabled').disabled = true;
            FunctionOne.updateAppState()
            Apphelpers.sendRequest(sendData, res => {
                appState.loader = false
                document.querySelector('.btnDisabled').disabled = false;
                if (res.status === 'success') {
                    FunctionOne.flash("success", res.message)
                    setTimeout(() => {
                        window.location = '/savings/reapgoal/village/' + villageId
                    }, 4000)
                } else {

                    return FunctionOne.flash("error", res.message)
                }

            })

        } else {
            let auth = document.querySelector('.mPayment')
            let authorization = auth.selectedOptions[0].getAttribute('data-authorization')
            if (authorization && authorization !== null) {
                let formData = new FormData()
                formData.append('token', token)
                formData.append('plan_target', target)
                formData.append('village_id', villageId)
                formData.append('payment_method', payment)
                formData.append('authorization', authorization)
                let sendData = {
                    url: Apphelpers.url.joinVillage,
                    method: 'POST',
                    body: formData
                }
                appState.loader = true
                document.querySelector('.btnDisabled').disabled = true;
                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
                Apphelpers.sendRequest(sendData, res => {
                    appState.loader = false
                    document.querySelector('.btnDisabled').disabled = false;
                    if (res.status === 'success') {
                        FunctionOne.flash("success", res.message)
                        setTimeout(() => {
                            window.location = '/savings/reapgoal/village/' + villageId
                        }, 4000)
                    } else {
                        return FunctionOne.flash("error", res.message)
                    }

                })
            } else {
                appState.payment.start = true
                document.querySelector('.btnDisabled').disabled = true;
                appState.payment.amount = amount
                appState.payment.villageId = villageId
                appState.payment.payment = payment

                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
            }
        }
    }

}

FunctionOne.CompleteJoinReapVillagePayment = (e) => {
    let token = appState.userDetails.token
    let amount = appState.payment.amount
    let villageId = appState.payment.villageId
    let payment = appState.payment.payment
    let reference = e.reference
    let status = e.status

    if (status !== "success") {
        return FunctionOne.flash("error", "Sorry this transaction was not successful")
    }

    let formData = new FormData()
    formData.append('token', token)
    formData.append('village_id', villageId)
    formData.append('payment_method', payment)
    formData.append('transaction_code', reference)
    formData.append('payment_method', 'paystack')
    formData.append('authorization', '')


    let sendData = {
        url: Apphelpers.url.joinVillage,
        method: 'POST',
        body: formData
    }
    appState.payment.start = null
    document.querySelector('.btnDisabled').disabled = true;
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        document.querySelector('.btnDisabled').disabled = false;
        appState.loader = false
        if (res.status === 'success') {
            FunctionOne.getWallet()

            FunctionOne.flash("success", res.message)
            setTimeout(() => {
                window.location = '/savings/reapgoal/village/' + villageId
            }, 4000)

        } else {

            return FunctionOne.flash("error", res.message)
        }

    })

}

//break village
FunctionOne.Breakvillage = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    // let { amount, breakid, planid } = e.target.elements
    let amount = document.querySelector('.amount')
    let breakid = document.querySelector('.breakid')
    let villageId = document.querySelector('.villageid')
    amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    // console.log(amount)
    amount = parseInt(amount)
    // console.log(amount)
    // return
    breakid = breakid && breakid.value.trim()
    villageId = villageId && villageId.value.trim()

    let modalContent = {
        title: 'Break Savings',
        message: "Breaking of Village savings will close this plan and also the interest accrued will be forfeited. Your capital will be returned to your wallet",
        callToAction: 'Do you want to continue?',
        amount: amount

    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAutoTarget = () => {

        let formData = new FormData()
        formData.append('token', token)
        formData.append('savings_id', breakid)
        formData.append('village_id', villageId)
        let sendData = {
            url: Apphelpers.url.Breakvillagesave,
            method: 'POST',
            body: formData
        }
        appState.loader = true
        document.querySelector('.btnDisabled').disabled = true;
        FunctionOne.updateAppState()
        Apphelpers.sendRequest(sendData, res => {
            document.querySelector('.btnDisabled').disabled = false;
            appState.loader = false
            if (res.status === 'success') {
                FunctionOne.flash("success", res.message)
                setTimeout(() => {
                    window.location.reload()
                }, 4000)
            } else {

                return FunctionOne.flash("error", res.message)
            }

        })
    }
}

//topup village
FunctionOne.Topupvillage = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    // let { amount, auto, frequency, payment, planid } = e.target.elements
    let title = document.querySelector('.targetTitle')
    let amount = document.querySelector('.amount')
    let planid = document.querySelector('.planid')
    let villageid = document.querySelector('.villageid')
    let auth = document.querySelector('.mPayment')
    let payment = auth.selectedOptions[0].value
    amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    amount = parseInt(amount)
    planid = planid && planid.value
    title = title && title.value

    if (!amount || amount === '') {
        return FunctionOne.flash("error", " Topup Amount is required")
    }
    if (amount < 500) {
        return FunctionOne.flash("error", " Topup Minimum funding amount is ₦500")
    }

    let modalContent = {
        title: 'Village Savings topup',
        message: "You are about to topup your " + title + " plan",
        callToAction: 'Do you want to continue?',
        amount: amount,
        payment: payment

    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAuto2 = () => {

        if (payment === 'wallet') {
            let formData = new FormData()
            formData.append('token', token)
            formData.append('saving_amount', amount)
            formData.append('payment_method', payment)
            formData.append('goal_id', planid)
            let sendData = {
                url: Apphelpers.url.Topupvillagesave,
                method: 'POST',
                body: formData
            }
            appState.loader = true
            document.querySelector('.btnDisabled').disabled = true;
            appState.loader = ReducerAction.loader.Payment
            FunctionOne.updateAppState()
            Apphelpers.sendRequest(sendData, res => {
                document.querySelector('.btnDisabled').disabled = false;
                appState.loader = false
                if (res.status === 'success') {
                    // FunctionOne.singleVillageSavings(villageid)
                    // FunctionOne.updateAppState()
                    FunctionOne.flash("success", res.message)
                    setTimeout(() => {
                        window.location.reload()
                    }, 4000)
                } else {

                    return FunctionOne.flash("error", res.message)
                }

            })

        } else {
            // let auth = document.querySelector('.mPayment')
            let authorization = auth.selectedOptions[0].getAttribute('data-authorization')
            if (authorization && authorization !== null) {
                let formData = new FormData()
                formData.append('token', token)
                formData.append('saving_amount', amount)
                formData.append('payment_method', payment)
                formData.append('goal_id', planid)
                formData.append('authorization', authorization)
                let sendData = {
                    url: Apphelpers.url.Topupvillagesave,
                    method: 'POST',
                    body: formData
                }
                appState.loader = true
                document.querySelector('.btnDisabled').disabled = true;
                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
                Apphelpers.sendRequest(sendData, res => {
                    appState.loader = false
                    document.querySelector('.btnDisabled').disabled = false;
                    if (res.status === 'success') {
                        // FunctionOne.singleVillageSavings(villageid)
                        FunctionOne.flash("success", res.message)
                        setTimeout(() => {
                            window.location.reload()
                        }, 4000)
                    } else {

                        return FunctionOne.flash("error", res.message)
                    }

                })
            } else {
                appState.payment.start = true
                appState.payment.amount = amount
                appState.payment.planid = planid
                appState.payment.payment = payment
                appState.payment.villageid = villageid

                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
            }
        }
    }

}

FunctionOne.CompleteTopupvillagesave = (e) => {
    let token = appState.userDetails.token
    let amount = appState.payment.amount
    let planid = appState.payment.planid
    let villageid = appState.payment.villageid
    let reference = e.reference
    let status = e.status

    if (status !== "success") {
        return FunctionOne.flash("error", "Sorry this transaction was not successful")
    }

    let formData = new FormData()
    formData.append('token', token)
    formData.append('saving_amount', amount)
    formData.append('transaction_code', reference)
    formData.append('payment_method', 'paystack')
    formData.append('goal_id', planid)
    formData.append('authorization', '')


    let sendData = {
        url: Apphelpers.url.Topupvillagesave,
        method: 'POST',
        body: formData
    }
    appState.payment.start = null
    document.querySelector('.btnDisabled').disabled = true;
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        document.querySelector('.btnDisabled').disabled = false;
        if (res.status === 'success') {
            // FunctionOne.singleVillageSavings(villageid)
            FunctionOne.flash("success", res.message)
            setTimeout(() => {
                window.location = '/savings/reapquick'
            }, 4000)

        } else {

            return FunctionOne.flash("error", res.message)
        }

    })

}

FunctionOne.UpdateVillage = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let { description, picture, villageid } = e.target.elements

    let pic = picture && picture.files[0]
    description = description && description.value.trim()
    villageid = villageid && villageid.value.trim()
    let formData = new FormData()
    formData.append('token', token)
    formData.append('village_id', villageid)
    formData.append('description', description)
    formData.append('photo', pic)
    // formData.append('mobile', mobile)
    let sendData = {
        url: Apphelpers.url.updateVillage,
        method: 'POST',
        body: formData
    }
    appState.loader = true
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {

            return FunctionOne.flash("success", res.message)
        } else {

            return FunctionOne.flash("error", res.message)
        }

    })
}

FunctionOne.ProcessChief = (e) => {
    e.preventDefault()
    // console.log(e)
    let token = appState.userDetails.token

    let chiefId = e.target.getAttribute('data-user')
    let villageId = e.target.getAttribute('villar')
    console.log(villageId)
    console.log(chiefId)

    let formData = new FormData()
    formData.append('token', token)
    formData.append('chief_id', chiefId)
    formData.append('village_id', villageId)
    let sendData = {
        url: Apphelpers.url.makeChief,
        method: 'POST',
        body: formData
    }
    appState.loader = ReducerAction.loader.Refer + chiefId
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {
            FunctionOne.flash("success", res.message)
            FunctionOne.singleVillageSavings(villageId)
            FunctionOne.updateAppState()
        } else {

            return FunctionOne.flash("error", res.message)
        }

    })

}

//village payment setting
FunctionOne.Paymentsettingvillage = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    // let { amount, auto, frequency, payment, planid } = e.target.elements
    let title = document.querySelector('.targetTitle')
    let amount = document.querySelector('.amount')
    let planid = document.querySelector('.planid')
    let villageid = document.querySelector('.villageid')
    let auth = document.querySelector('.mPayment')
    let payment = auth.selectedOptions[0].value
    amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    amount = parseInt(amount)
    planid = planid && planid.value
    title = title && title.value
    let authorization1 = auth.selectedOptions[0].getAttribute('data-authorization')

    let modalContent = {
        title: 'Village Payment Setting',
        message: "You are about change the payment option for " + title + " plan",
        callToAction: 'Do you want to continue?',
        amount: amount,
        payment: payment,
        authur: authorization1 === null ? 'null' : authorization1

    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAuto2 = () => {

        if (payment === 'wallet') {
            let formData = new FormData()
            formData.append('token', token)
            formData.append('saving_amount', amount)
            formData.append('payment_method', payment)
            formData.append('goal_id', planid)
            let sendData = {
                url: Apphelpers.url.VillagePaymentSetting,
                method: 'POST',
                body: formData
            }
            appState.loader = true
            document.querySelector('.btnDisabled').disabled = true;
            appState.loader = ReducerAction.loader.Payment
            FunctionOne.updateAppState()
            Apphelpers.sendRequest(sendData, res => {
                document.querySelector('.btnDisabled').disabled = false;
                appState.loader = false
                if (res.status === 'success') {
                    // FunctionOne.singleVillageSavings(villageid)
                    FunctionOne.flash("success", res.message)
                    setTimeout(() => {
                        window.location.reload()
                    }, 4000)
                } else {

                    return FunctionOne.flash("error", res.message)
                }

            })

        } else {
            // let auth = document.querySelector('.mPayment')
            let authorization = auth.selectedOptions[0].getAttribute('data-authorization')
            if (authorization && authorization !== null) {
                let formData = new FormData()
                formData.append('token', token)
                formData.append('saving_amount', amount)
                formData.append('payment_method', payment)
                formData.append('goal_id', planid)
                formData.append('authorization', authorization)
                let sendData = {
                    url: Apphelpers.url.VillagePaymentSetting,
                    method: 'POST',
                    body: formData
                }
                appState.loader = true
                document.querySelector('.btnDisabled').disabled = true;
                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
                Apphelpers.sendRequest(sendData, res => {
                    appState.loader = false
                    document.querySelector('.btnDisabled').disabled = false;
                    if (res.status === 'success') {
                        // FunctionOne.singleVillageSavings(villageid)
                        FunctionOne.flash("success", res.message)
                        setTimeout(() => {
                            window.location.reload()
                        }, 4000)
                    } else {

                        return FunctionOne.flash("error", res.message)
                    }

                })
            } else {
                appState.payment.start = true
                appState.payment.amount = amount
                appState.payment.planid = planid
                appState.payment.payment = payment
                appState.payment.villageid = villageid

                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
            }
        }
    }

}

FunctionOne.CompleteVillagePaymentSetting = (e) => {
    let token = appState.userDetails.token
    let amount = appState.payment.amount
    let planid = appState.payment.planid
    let villageid = appState.payment.villageid
    let reference = e.reference
    let status = e.status

    if (status !== "success") {
        return FunctionOne.flash("error", "Sorry this transaction was not successful")
    }

    let formData = new FormData()
    formData.append('token', token)
    formData.append('saving_amount', amount)
    formData.append('transaction_code', reference)
    formData.append('payment_method', 'paystack')
    formData.append('goal_id', planid)
    formData.append('authorization', '')


    let sendData = {
        url: Apphelpers.url.VillagePaymentSetting,
        method: 'POST',
        body: formData
    }
    appState.payment.start = null
    document.querySelector('.btnDisabled').disabled = true;
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        document.querySelector('.btnDisabled').disabled = false;
        if (res.status === 'success') {
            // FunctionOne.singleVillageSavings(villageid)
            FunctionOne.flash("success", res.message)
            setTimeout(() => {
                window.location.reload()
            }, 4000)

        } else {

            return FunctionOne.flash("error", res.message)
        }

    })

}
/**
 * Village ends here
 */

//goal savings ends here

FunctionOne.toggleJoinVillage = () => {
    let x = document.querySelector('#joinBox')
    if (x.style.display === "none") {
        x.style.display = "block";
        // FunctionOne.updateAppState()
    } else {
        x.style.display = "none";
    }

}


FunctionOne.ProcessLogin = (e) => {
    e.preventDefault()
    let { username, password } = e.target.elements
    username = username && username.value.trim()
    password = password && password.value.trim()
    if (!username || username === '') {

        return FunctionOne.flash("error", "A valid email or mobile number is required")
    }
    if (!password || password === '' || password.length < 6) {

        return FunctionOne.flash("error", "A valid password is required")
    }
    let formData = new FormData()
    formData.append('username', username)
    formData.append('password', password)
    let sendData = {
        url: Apphelpers.url.Login,
        method: 'POST',
        body: formData
    }
    appState.loader = true
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status !== 'success') {

            return FunctionOne.flash("error", res.message)
        }
        appState.userDetails = res.message
        console.log(res)
        // return
        appState.auth = true
        localStorage.setItem('_htoken', res.message.token)
        Apphistory.push('/dashboard')
    })
}
FunctionOne.ProcessPassword = (e) => {
    e.preventDefault()
    let { code, password, newpassword } = e.target.elements
    code = code && code.value.trim()
    password = password && password.value.trim()
    newpassword = newpassword && newpassword.value.trim()
    if (!code || code === '') {

        return FunctionOne.flash("error", "A valid reset code is required")
    }
    if (!password || password === '' || password.length < 6) {

        return FunctionOne.flash("error", "A valid password is required")
    }
    if (!newpassword || newpassword === '' || newpassword.length < 6) {

        return FunctionOne.flash("error", "A valid confirm password is required")
    }
    if (password !== newpassword) {

        return FunctionOne.flash("error", "Please put a matching password")
    }
    let formData = new FormData()
    formData.append('code', code)
    formData.append('password', password)
    let sendData = {
        url: Apphelpers.url.Newpassword,
        method: 'POST',
        body: formData
    }
    appState.loader = true
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {
            FunctionOne.flash("success", res.message)
            setTimeout(() => {
                window.location = '/login'
            }, 3000)
        } else {

            return FunctionOne.flash("error", res.message)
        }

    })
}
FunctionOne.ConfirmAccount = (e) => {
    e.preventDefault()
    let { code } = e.target.elements
    code = code && code.value.trim()
    // console.log(code)
    if (!code || code === '') {
        return FunctionOne.flash("error", "A valid confirmation code is required")
    }
    console.log(code)
    let formData = new FormData()
    formData.append('code', code)
    let sendData = {
        url: Apphelpers.url.ConfirmAccount,
        method: 'POST',
        body: formData
    }
    appState.loader = true
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {
            FunctionOne.flash("success", res.message)
            setTimeout(() => {
                localStorage.removeItem('_htoken')
                window.location = '/login'
            }, 3000)
        } else {

            return FunctionOne.flash("error", res.message)
        }

    })
}
FunctionOne.ConfirmAccount2 = (e) => {
    e.preventDefault()
    let { code } = e.target.elements
    code = code && code.value.trim()
    // console.log(code)
    if (!code || code === '') {
        return FunctionOne.flash("error", "A valid confirmation code is required")
    }
    console.log(code)
    let formData = new FormData()
    formData.append('code', code)
    let sendData = {
        url: Apphelpers.url.ConfirmAccount,
        method: 'POST',
        body: formData
    }
    appState.loader = true
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {
            FunctionOne.flash("success", res.message)
            setTimeout(() => {
                // localStorage.removeItem('_htoken')
                window.location = '/'
            }, 3000)
        } else {

            return FunctionOne.flash("error", res.message)
        }

    })
}
FunctionOne.ProcessReset = (e) => {
    e.preventDefault()
    let { email } = e.target.elements
    email = email && email.value.trim()
    if (!email || email === '') {

        return FunctionOne.flash("error", "Enter your registered email address")
    }
    let formData = new FormData()
    formData.append('email', email)
    let sendData = {
        url: Apphelpers.url.Reset,
        method: 'POST',
        body: formData
    }
    appState.loader = true
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {

            return FunctionOne.flash("success", res.message)
        } else {

            return FunctionOne.flash("error", res.message)
        }

    })
}
// function to confirm the login user
FunctionOne.confirmLogin = () => {
    if (appState.auth === true) {
        return
    }
    let token = localStorage.getItem("_htoken")
    // return console.log(token)
    if (token === null) {
        return Apphistory.push('/login')
        // localStorage.removeItem('_htoken')
        // return window.location = '/login'
    }

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.confirmLogin,
        method: 'POST',
        body: formData
    }
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status !== 'success') {
            localStorage.removeItem('_htoken')
            return window.location = '/login'
        }
        appState.userDetails = res.message
        appState.auth = true
        FunctionOne.updateAppState()
        // Apphistory.push('/dashboard')
    })
}

FunctionOne.getHistory = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.getHistory,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.type = ReducerAction.result.userActivity
        appState.result.data = res
        FunctionOne.updateAppState()
    })
}
FunctionOne.getAllHistory = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.getAllHistory,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.type = ReducerAction.result.userActivity
        appState.result.data = res
        FunctionOne.updateAppState()
        console.log(res)
    })
}

FunctionOne.updateAppState = () => {
    dispatcher({
        type: ReducerAction.updateAppstate
    })
}

//process registration
FunctionOne.ProcessRegister = (e) => {
    e.preventDefault()
    let { firstname, lastname, email, mobile, referral, agree, password } = e.target.elements
    firstname = firstname && firstname.value.trim()
    lastname = lastname && lastname.value.trim()
    email = email && email.value.trim()
    mobile = mobile && mobile.value.trim()
    referral = referral && referral.value.trim()
    password = password && password.value.trim()
    agree = agree.checked
    if (!firstname || firstname === '' || firstname.length < 2) {

        return FunctionOne.flash("error", "A valid firstname is required")
    }
    if (!lastname || lastname === '' || lastname.length < 2) {

        return FunctionOne.flash("error", "A valid lastname is required")
    }
    if (!email || email === '') {

        return FunctionOne.flash("error", "A valid email is required")
    }
    if (!mobile || mobile === '') {

        return FunctionOne.flash("error", "A valid mobile is required")
    }
    if (!password || password === '' || password.length < 6) {

        return FunctionOne.flash("error", "A valid password is required")
    }
    if (!agree) {

        return FunctionOne.flash("error", "Please agree to our terms and conditions")
    }

    let formData = new FormData()
    formData.append('firstname', firstname)
    formData.append('lastname', lastname)
    formData.append('email', email)
    formData.append('mobile', mobile)
    formData.append('referer', referral)
    formData.append('password', password)
    let sendData = {
        url: Apphelpers.url.Register,
        method: 'POST',
        body: formData
    }
    appState.loader = true
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {

            return FunctionOne.flash("success", res.message)
        } else {

            return FunctionOne.flash("error", res.message)
        }

    })
}
//to check if the user is login
FunctionOne.Checkers = (route) => {
    if (localStorage.getItem('_htoken') !== null) {
        Apphistory.push(route)

    }

}

FunctionOne.getUsercard = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.Usercards,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.cards = res
        FunctionOne.updateAppState()
    })
}
FunctionOne.getPreviousQuick = (id) => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    formData.append('savings_plan_id', id)
    let sendData = {
        url: Apphelpers.url.Previoussavings,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.previousquick = res
        FunctionOne.updateAppState()
    })
}
FunctionOne.getAllSavings = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.OldSavings,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.allmysavings = res
        FunctionOne.updateAppState()
    })
}
FunctionOne.getAllUserInvestments = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.UserInvestment,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.allmyinvestments = res
        FunctionOne.updateAppState()
    })
}
FunctionOne.getWallet = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.userWallet,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.wallet = res
        FunctionOne.updateAppState()
    })
}
FunctionOne.getUserInvestment = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.UserInvestment,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.userinvest = res
        FunctionOne.updateAppState()
    })
}
FunctionOne.getUserPaidInvestment = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.UserPaidInvestment,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.paid = res
        FunctionOne.updateAppState()
    })
}
FunctionOne.getAllInvestment = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.AllInvestment,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.allinvest = res
        // console.log(res)
        FunctionOne.updateAppState()
    })
}
FunctionOne.getSingleInvestment = (slug) => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    if (!slug || slug === '') {
        return dispatcher({
            type: ReducerAction.error,
            payload: "Invalid Investment",
            status: 'error'
        })
    }

    let formData = new FormData()
    formData.append('token', token)
    formData.append('investment_id', slug)
    let sendData = {
        url: Apphelpers.url.SingleInvestment,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.singleinvest = res
        FunctionOne.updateAppState()
    })
}
FunctionOne.getUserSingleInvestment = (slug) => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    if (!slug || slug === '') {
        return dispatcher({
            type: ReducerAction.error,
            payload: "Invalid Investment",
            status: 'error'
        })
    }

    let formData = new FormData()
    formData.append('token', token)
    formData.append('investment_id', slug)
    let sendData = {
        url: Apphelpers.url.UserSingleInvestment,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.usersingle = res
        FunctionOne.updateAppState()
    })
}
FunctionOne.redeemInterest = (e) => {
    e.preventDefault()
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(e.target.elements)
    let { amount } = e.target.elements
    amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    // console.log(amount)
    // return
    if (!amount || amount === '') {
        return FunctionOne.flash("error", "Amount is required")
    }
    let regexp = /^\d+(\.\d{1,2})?$/;
    if (!regexp.test(amount)) {
        return FunctionOne.flash("error", "Invalid Amount")
    }
    let formData = new FormData()
    formData.append('token', token)
    formData.append('amount', amount)
    let sendData = {
        url: Apphelpers.url.redeemInterest,
        method: 'POST',
        body: formData
    }
    appState.loader = true
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {
            FunctionOne.confirmLogin()
            FunctionOne.getWallet()
            FunctionOne.updateAppState()

            return FunctionOne.flash("success", res.message)

        } else {

            return FunctionOne.flash("error", res.message)
        }

    })
}
FunctionOne.ProcessWithdrawal = (e) => {
    e.preventDefault()
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    // return console.log(token)
    let { amount, pwd, testimony } = e.target.elements
    amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    pwd = pwd && pwd.value.trim()
    if (!amount || amount === '') {

        return FunctionOne.flash("error", "Amount is required")
    }
    if (!pwd || pwd === '') {

        return FunctionOne.flash("error", "Password is required")
    }
    if (pwd.length < 6) {

        return FunctionOne.flash("error", "Invalid password")
    }
    let formData = new FormData()
    formData.append('token', token)
    formData.append('amount', amount)
    formData.append('password', pwd)
    formData.append('testimony', testimony)
    let sendData = {
        url: Apphelpers.url.withdrawfromwallet,
        method: 'POST',
        body: formData
    }
    appState.loader = true
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {
            FunctionOne.confirmLogin()
            FunctionOne.getWallet()
            FunctionOne.updateAppState()

            return FunctionOne.flash("success", res.message)

        } else {

            return FunctionOne.flash("error", res.message)
        }

    })
}

FunctionOne.UpdatePassword = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let { oldpwd, password, newpassword } = e.target.elements
    oldpwd = oldpwd && oldpwd.value.trim()
    password = password && password.value.trim()
    newpassword = newpassword && newpassword.value.trim()
    if (!oldpwd || oldpwd === '' || oldpwd.length < 6) {

        return FunctionOne.flash("error", "Your old password is required")
    }
    if (!password || password === '' || password.length < 6) {

        return FunctionOne.flash("error", "A valid password is required")
    }
    if (!newpassword || newpassword === '' || newpassword.length < 6) {

        return FunctionOne.flash("error", "A valid confirm password is required")
    }
    if (password !== newpassword) {

        return FunctionOne.flash("error", "Please put a matching password")
    }
    let formData = new FormData()
    formData.append('token', token)
    formData.append('old_password', oldpwd)
    formData.append('new_password', password)
    let sendData = {
        url: Apphelpers.url.updatePassword,
        method: 'POST',
        body: formData
    }
    appState.loader = true
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {

            FunctionOne.flash("success", res.message)
            localStorage.removeItem('_htoken')
            setTimeout(() => {
                return Apphistory.push('/login')
            }, 3000)
        } else {

            return FunctionOne.flash("error", res.message)
        }

    })
}
FunctionOne.Addbank = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    let { accountnumber, bank } = e.target.elements
    // return
    let bankcode = bank.options[bank.selectedIndex]
    let mybank = bankcode.value
    let bankCode = bankcode.getAttribute('data-code')

    accountnumber = accountnumber && accountnumber.value.trim()

    if (!accountnumber || accountnumber === '' || accountnumber.length !== 10) {

        return FunctionOne.flash("error", "Valid Account number is required")
    }

    if (!mybank || mybank === '') {
        return FunctionOne.flash("error", "Valid bank is required")
    }

    let formData = new FormData()
    formData.append('token', token)
    formData.append('account_number', accountnumber)
    formData.append('bank_name', mybank)
    formData.append('bank_code', bankCode)
    let sendData = {
        url: Apphelpers.url.addAccountNumber,
        method: 'POST',
        body: formData
    }
    appState.loader = true
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {

            FunctionOne.flash("success", res.message)
            // localStorage.removeItem('_htoken')
            setTimeout(() => {
                window.location.reload()
            }, 3000)
        } else {

            return FunctionOne.flash("error", res.message)
        }

    })
}
FunctionOne.ProcessBVN = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    // let { bvn } = e.target.elements
    let bvn = document.querySelector('.mybvn')
    bvn = bvn && bvn.value.trim()
    if (!bvn || bvn === '' || bvn.length !== 11) {

        return FunctionOne.flash("error", "Valid Bvn is required")
    }
    let modalContent = {
        title: 'Bvn Update',
        message: 'Please make sure this is your correct BVN because it will be used to validate your account number for withdrawal',
        callToAction: 'Do you want to continue?',
        bvn: bvn

    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAuto2 = () => {

        let formData = new FormData()
        formData.append('token', token)
        formData.append('bvn', bvn)
        let sendData = {
            url: Apphelpers.url.addbvn2,
            method: 'POST',
            body: formData
        }
        appState.loader = true
        FunctionOne.updateAppState()
        Apphelpers.sendRequest(sendData, res => {
            appState.loader = false
            if (res.status === 'success') {
                FunctionOne.flash("success", res.message)
                // localStorage.removeItem('_htoken')
                setTimeout(() => {
                    window.location.reload()
                }, 3000)
            } else {

                return FunctionOne.flash("error", res.message)
            }

        })
    }
}
FunctionOne.Verifyemail = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let email = appState.userDetails.email
    let modalContent = {
        title: 'Email Verification',
        message: 'A verification code will be send to this email address above.',
        callToAction: 'Do you want to continue?',
        email: email

    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAuto2 = () => {

        let formData = new FormData()
        formData.append('token', token)
        formData.append('email', email)
        let sendData = {
            url: Apphelpers.url.Reset2,
            method: 'POST',
            body: formData
        }
        appState.loader = true
        FunctionOne.updateAppState()
        Apphelpers.sendRequest(sendData, res => {
            appState.loader = false
            if (res.status === 'success') {
                return FunctionOne.flash("success", res.message)
                // setTimeout(() => {
                //     window.location = '/profile'
                // }, 3000)
            } else {

                return FunctionOne.flash("error", res.message)
            }

        })
    }
}

FunctionOne.RandomString1 = (len) => {
    var p = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return [...Array(len)].reduce(a => a + p[~~(Math.random() * p.length)], '');
}
FunctionOne.Fundwallet = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let email = appState.userDetails.email
    let bvn = appState.userDetails.user_bvn
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    // let { amount, auto, frequency } = e.target.elements
    let amount = document.querySelector('.amount')
    let auto = document.querySelector('.auto')
    let frequency = document.querySelector('.frequency')
    amount = amount && amount.value.trim()

    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    // console.log(amount)
    // return
    auto = auto && auto.value.trim()
    frequency = frequency && frequency.value
    if (bvn === false) {
        return FunctionOne.flash("error", "You need to update your bvn to be able to fund your wallet")
    }
    if (!amount || amount === '') {

        return FunctionOne.flash("error", "Amount is required")
    }
    if (amount < 500) {
        return FunctionOne.flash("error", "Minimum funding amount is ₦500")
    }
    if (auto === 1 || auto === '1') {
        if (frequency === 0 || frequency === '0') {
            return FunctionOne.flash("error", "Please select the frequency at which you want to be debited")
        }
    }
    let modalContent = {
        title: 'Wallet Quick topup',
        message: 'Your are about to topup your wallet',
        callToAction: 'Do you want to continue?',
        amount: amount,
        payment: 'paystack'

    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAuto2 = () => {

        let auth = document.querySelector('.mPayment')
        let authorization = auth.selectedOptions[0].getAttribute('data-authorization')

        if (authorization !== null) {
            let formData = new FormData()
            formData.append('token', token)
            formData.append('saving_amount', amount)
            formData.append('auto_save', auto)
            formData.append('auto_save_duration', frequency)
            formData.append('authorization', authorization)

            let sendData = {
                url: Apphelpers.url.Fundwallet,
                method: 'POST',
                body: formData
            }
            appState.payment.start = null
            appState.loader = ReducerAction.loader.Payment
            FunctionOne.updateAppState()
            Apphelpers.sendRequest(sendData, res => {
                appState.loader = false
                if (res.status === 'success') {
                    FunctionOne.confirmLogin()
                    FunctionOne.getWallet()
                    FunctionOne.updateAppState()

                    return FunctionOne.flash("success", res.message)

                } else {

                    return FunctionOne.flash("error", res.message)
                }

            })

        } else {
            appState.payment.start = true
            appState.payment.amount = amount
            appState.payment.auto = auto
            appState.payment.frequency = frequency
            appState.loader = ReducerAction.loader.Payment
            FunctionOne.updateAppState()
        }
    }


}
FunctionOne.Fundwallet2 = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let email = appState.userDetails.email
    let bvn = appState.userDetails.user_bvn
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    // let { amount, auto, frequency } = e.target.elements
    let amount = document.querySelector('.amount')
    let auto = document.querySelector('.auto')
    let frequency1 = document.querySelector('.frequency')
    amount = amount && amount.value.trim()

    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    // console.log(amount)
    // return
    auto = auto && auto.value.trim()
    let frequency = frequency1.selectedOptions[0].value
    if (bvn === false) {
        return FunctionOne.flash("error", "You need to update your bvn to be able to fund your wallet")
    }
    if (!amount || amount === '') {

        return FunctionOne.flash("error", "Amount is required")
    }
    if (amount < 500) {
        return FunctionOne.flash("error", "Minimum funding amount is ₦500")
    }
    if (auto === 1 || auto === '1') {
        if (frequency === 0 || frequency === '0') {
            return FunctionOne.flash("error", "Please select the frequency at which you want to be debited")
        }
    }

    let modalContent = {
        title: 'Start Auto Savings on Wallet',
        message: 'Your are about to start Auto debit on Wallet. Please note that, Reaprite will have Authorization to debit your bank account on your behalf',
        callToAction: 'Do you want to continue?',
        amount: amount,
        duration: frequency === '1' ? 'Daily' : frequency === '7' ? 'Weekly' : frequency === '30' ? 'Monthly' : ''

    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAuto = () => {

        let auth = document.querySelector('.mPayment')
        let authorization = auth.selectedOptions[0].getAttribute('data-authorization')
        // console.log(authorization)

        if (authorization && authorization !== null) {
            let formData = new FormData()
            formData.append('token', token)
            formData.append('saving_amount', amount)
            formData.append('auto_save', auto)
            formData.append('auto_save_duration', frequency)
            formData.append('authorization', authorization)

            let sendData = {
                url: Apphelpers.url.Fundwallet,
                method: 'POST',
                body: formData
            }
            appState.payment.start = null
            appState.loader = ReducerAction.loader.Payment
            FunctionOne.updateAppState()
            Apphelpers.sendRequest(sendData, res => {
                appState.loader = false
                if (res.status === 'success') {
                    FunctionOne.confirmLogin()
                    FunctionOne.getWallet()
                    FunctionOne.updateAppState()

                    return FunctionOne.flash("success", res.message)

                } else {

                    return FunctionOne.flash("error", res.message)
                }

            })

        } else {
            appState.payment.start = true
            appState.payment.amount = amount
            appState.payment.auto = auto
            appState.payment.frequency = frequency
            appState.loader = ReducerAction.loader.Payment
            FunctionOne.updateAppState()
        }

    }

}
FunctionOne.CompleteWalletPayment = (e) => {
    let token = appState.userDetails.token
    let amount = appState.payment.amount
    let auto = appState.payment.auto
    let frequency = appState.payment.frequency
    let reference = e.reference
    let status = e.status
    if (status !== "success") {

        return FunctionOne.flash("error", "Sorry this transaction was not successful")
    }

    let formData = new FormData()
    formData.append('token', token)
    formData.append('saving_amount', amount)
    formData.append('auto_save', auto)
    formData.append('auto_save_duration', frequency)
    formData.append('transaction_code', reference)

    let sendData = {
        url: Apphelpers.url.Fundwallet,
        method: 'POST',
        body: formData
    }
    appState.payment.start = null
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {
            FunctionOne.confirmLogin()
            FunctionOne.getWallet()
            FunctionOne.updateAppState()

            return FunctionOne.flash("success", res.message)

        } else {

            return FunctionOne.flash("error", res.message)
        }

    })

}
FunctionOne.Cancelpayment = () => {
    appState.payment.start = null
    appState.loader = false
    document.querySelector('.btnDisabled').disabled = false;
    FunctionOne.updateAppState()
}
FunctionOne.UpdateAccount = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let { dob, gender, picture } = e.target.elements

    let pic = picture && picture.files[0]
    gender = gender && gender.value.trim()
    dob = dob && dob.value.trim()
    let formData = new FormData()
    formData.append('token', token)
    formData.append('dob', dob)
    formData.append('gender', gender)
    formData.append('photo', pic)
    // formData.append('mobile', mobile)
    let sendData = {
        url: Apphelpers.url.updateAccount,
        method: 'POST',
        body: formData
    }
    appState.loader = true
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {

            return FunctionOne.flash("success", res.message)
        } else {

            return FunctionOne.flash("error", res.message)
        }

    })
}
FunctionOne.Offautodebit = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    // let { planid } = e.target.elements
    let planid = document.querySelector('.planid')


    planid = planid && planid.value.trim()
    let modalContent = {
        title: 'Stop Auto debit for savings',
        message: 'Your are about to stop Auto debit for this savings plan. If Auto debit is stopped, Reaprite will no longer have Authorization to debit your bank account on your behalf',
        callToAction: 'Do you want to continue?'

    }


    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAuto3 = () => {

        let formData = new FormData()
        formData.append('token', token)
        formData.append('savings_id', planid)
        // formData.append('mobile', mobile)
        let sendData = {
            url: Apphelpers.url.Offautodebit,
            method: 'POST',
            body: formData
        }
        appState.loader = true
        FunctionOne.updateAppState()
        Apphelpers.sendRequest(sendData, res => {
            appState.loader = false
            if (res.status === 'success') {
                FunctionOne.flash("success", res.message)
                setTimeout(() => {
                    window.location.reload()
                }, 3000)

            } else {

                return FunctionOne.flash("error", res.message)
            }

        })
    }
}
FunctionOne.Stopautodebitwallet = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token

    let modalContent = {
        title: 'Stop Auto debit for Wallet',
        message: 'Your are about to stop Auto debit for Wallet. If Auto debit is stopped, Reaprite will no longer have Authorization to debit your bank account on your behalf',
        callToAction: 'Do you want to continue?'

    }
    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAuto3 = () => {

        let formData = new FormData()
        formData.append('token', token)
        // formData.append('mobile', mobile)
        let sendData = {
            url: Apphelpers.url.Stopautodebitwallet,
            method: 'POST',
            body: formData
        }
        appState.loader = true
        FunctionOne.updateAppState()
        Apphelpers.sendRequest(sendData, res => {
            appState.loader = false
            if (res.status === 'success') {
                FunctionOne.flash("success", res.message)
                setTimeout(() => {
                    window.location.reload()
                }, 3000)

            } else {

                return FunctionOne.flash("error", res.message)
            }

        })
    }
}
FunctionOne.ProcessNok = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let { fullname, relationship, email, mobile, password } = e.target.elements
    fullname = fullname && fullname.value.trim()
    email = email && email.value.trim()
    mobile = mobile && mobile.value.trim()
    password = password && password.value.trim()
    relationship = relationship && relationship.value.trim()
    if (!fullname || fullname === '' || fullname.length < 2) {

        return FunctionOne.flash("error", "A valid fullname is required")
    }
    if (!relationship || relationship === '' || relationship.length < 2) {

        return FunctionOne.flash("error", "A valid relationship is required")
    }
    if (!email || email === '') {

        return FunctionOne.flash("error", "A valid email is required")
    }
    if (!mobile || mobile === '') {

        return FunctionOne.flash("error", "A valid mobile is required")
    }
    if (!password || password === '' || password.length < 6) {

        return FunctionOne.flash("error", "A valid password is required")
    }


    let formData = new FormData()
    formData.append('token', token)
    formData.append('fullname', fullname)
    formData.append('email', email)
    formData.append('mobile', mobile)
    formData.append('relationship', relationship)
    formData.append('password', password)
    let sendData = {
        url: Apphelpers.url.nextOfKin,
        method: 'POST',
        body: formData
    }
    appState.loader = true
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {

            return FunctionOne.flash("success", res.message)
        } else {

            return FunctionOne.flash("error", res.message)
        }

    })
}
FunctionOne.getBank = () => {
    let sendData = {
        url: Apphelpers.url.getBanks,
        method: 'POST',
        body: ''
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.banks = res
        // console.log(res)
        FunctionOne.updateAppState()
    })

}
FunctionOne.getPercentInvest = (date1, date2) => {
    const spliter2 = date1.split('-')
    const spliter1 = date2.split('-')
    const d1 = new Date(spliter2[1] + '/' + spliter2[0] + '/' + spliter2[2])
    const d2 = new Date(spliter1[1] + '/' + spliter1[0] + '/' + spliter1[2])
    const diff = Math.abs(d2.getTime() - d1.getTime())
    const dof = Math.ceil(diff / (1000 * 3600 * 24))
    // console.log(dof)
    const today = new Date()
    var dd = today.getDate()
    if (dd < 10) {
        dd = '0' + dd
    }
    var mm = today.getMonth() + 1
    if (mm < 10) {
        mm = '0' + mm
    }
    const yyyy = today.getFullYear()
    const together = new Date(mm + '/' + dd + '/' + yyyy);
    const diff2 = Math.abs(together.getTime() - d1.getTime())
    const dof1 = Math.ceil(diff2 / (1000 * 3600 * 24))

    return Math.round(((dof1 / dof) * 100))

}
FunctionOne.getDayInvest = (date1, date2) => {
    const spliter2 = date1.split('-')
    const spliter1 = date2.split('-')

    // const d1 = new Date('1/02/2021')
    const d1 = new Date(spliter2[1] + '/' + spliter2[0] + '/' + spliter2[2])
    const d2 = new Date(spliter1[1] + '/' + spliter1[0] + '/' + spliter1[2])
    const diff = Math.abs(d2.getTime() - d1.getTime())
    const dof = Math.ceil(diff / (1000 * 3600 * 24))
    // console.log(dof)
    const today = new Date()
    var dd = today.getDate()
    if (dd < 10) {
        dd = '0' + dd
    }
    var mm = today.getMonth() + 1
    if (mm < 10) {
        mm = '0' + mm
    }
    const yyyy = today.getFullYear()
    const together = new Date(mm + '/' + dd + '/' + yyyy);
    const diff2 = Math.abs(together.getTime() - d1.getTime())
    const dof1 = Math.ceil(diff2 / (1000 * 3600 * 24))
    return (dof - dof1 - 1)


}
//function to logout user
FunctionOne.logOut = () => {
    localStorage.removeItem('_htoken')
    window.location = '/'
}

FunctionOne.getPaidReferalsBonus = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.getPaidReferal,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.getPaidReferal = res
        FunctionOne.updateAppState()
    })
}
FunctionOne.getMyreferrals = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.getMyreferrals,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.getMyreferrals = res
        FunctionOne.updateAppState()
    })
}
FunctionOne.getReferalsBonus = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.referalBonus,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.referralbonus = res
        FunctionOne.updateAppState()
    })
}
FunctionOne.getSignupBonus = () => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    // return console.log(token)

    let formData = new FormData()
    formData.append('token', token)
    let sendData = {
        url: Apphelpers.url.signupBonus,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        appState.result.signupbonus = res
        FunctionOne.updateAppState()
    })
}


FunctionOne.flashTimer = null
FunctionOne.flash = (status, text, hide = true) => {
    dispatcher({ type: ReducerAction.error, status: status, payload: text })


    //check the old timer
    if (FunctionOne.flashTimer) {
        clearTimeout(FunctionOne.flashTimer)
    }
    //if auto hide is enable
    if (hide) {
        FunctionOne.flashTimer = setTimeout(() => {
            dispatcher({ type: ReducerAction.error, status: status, payload: null })
        }, 7000)
    }
}

FunctionOne.Copy = (mylink) => {
    //    let {mylink} = e.target.elements
    let i = document.createElement('input')
    document.body.append(i)
    i.value = mylink.textContent
    i.select()
    document.execCommand('copy', false);
    i.remove()
}


FunctionOne.ProcessTable = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let bvn = appState.userDetails.user_bvn
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    let bonus = e.target.getAttribute('data-id')
    if (bvn === false) {
        return FunctionOne.flash("error", "You need to update your bvn to be able to perform this task")
    }
    let formData = new FormData()
    formData.append('token', token)
    formData.append('bonus_id', bonus)
    let sendData = {
        url: Apphelpers.url.ProcessBonus,
        method: 'POST',
        body: formData
    }
    appState.loader = ReducerAction.loader.Refer + bonus
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {
            FunctionOne.flash("success", res.message)
            FunctionOne.getSignupBonus()
            FunctionOne.confirmLogin()
            FunctionOne.getWallet()
            FunctionOne.updateAppState()
            // setTimeout(() => {
            //     window.location = '/profile'
            // }, 2000)
            // FunctionOne.updateAppState()
        } else {

            return FunctionOne.flash("error", res.message)
        }

    })

}
FunctionOne.ProcessReferral = (e) => {
    // e.preventDefault()
    let token = appState.userDetails.token
    let bvn = appState.userDetails.user_bvn
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    let user = e.target.getAttribute('data-user')
    let refer = e.target.getAttribute('refer')
    if (bvn === false) {
        return FunctionOne.flash("error", "You need to update your bvn to be able to perform this task")
    }
    let formData = new FormData()
    formData.append('token', token)
    formData.append('bonus_id', user)
    formData.append('referal_id', refer)
    let sendData = {
        url: Apphelpers.url.ProcessBonus,
        method: 'POST',
        body: formData
    }
    appState.loader = ReducerAction.loader.Refer + user
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {
            FunctionOne.flash("success", res.message)
            FunctionOne.getReferalsBonus()
            FunctionOne.confirmLogin()
            FunctionOne.getWallet()
            FunctionOne.updateAppState()
            // FunctionOne.updateAppState()
            // setTimeout(() => {
            //     window.location = '/profile'
            // }, 2000)
        } else {

            return FunctionOne.flash("error", res.message)
        }

    })

}
FunctionOne.RemoveCard = (e) => {
    // e.preventDefault()
    let token = appState.userDetails.token
    let cardId = e.target.getAttribute('data-id')
    // console.log(cardId)
    let modalContent = {
        title: 'Remove bank card',
        message: 'Your are about to reomve this card from Reaprite. Note that Auto debit will be turned off if this card is used in setting auto debit',
        callToAction: 'Do you want to continue?'

    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAuto3 = () => {

        let formData = new FormData()
        formData.append('token', token)
        formData.append('card_id', cardId)
        let sendData = {
            url: Apphelpers.url.Removecards,
            method: 'POST',
            body: formData
        }
        appState.loader = ReducerAction.loader.Cards + cardId
        FunctionOne.updateAppState()
        Apphelpers.sendRequest(sendData, res => {
            appState.loader = false
            if (res.status === 'success') {
                FunctionOne.flash("success", res.message)
                // FunctionOne.confirmLogin()
                // FunctionOne.getUsercard()
                // FunctionOne.updateAppState()
                setTimeout(() => {
                    window.location.reload()
                }, 3000)
            } else {
                return FunctionOne.flash("error", res.message)
            }

        })
    }
}


FunctionOne.RegisterReapquick = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let bvn = appState.userDetails.user_bvn
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    // let { amount, auto, frequency, target, duration, payment } = e.target.elements
    let target = document.querySelector('.target')
    let amount = document.querySelector('.amount')
    let auto1 = document.querySelector('.auto')
    let auth = document.querySelector('.mPayment')
    let payment = auth.selectedOptions[0].value
    let frequency1 = document.querySelector('.frequency')
    let frequency = frequency1.selectedOptions[0].value
    let duration1 = document.querySelector('.duration')
    let duration = duration1.selectedOptions[0].value
    let auto = auto1.selectedOptions[0].value

    amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    target = target && target.value.trim()
    target = target.replace(/\,/g, '')
    target = target.replace(/\₦/g, '')
    // payment = payment && payment.value.trim()
    // duration = duration && duration.value.trim()
    // auto = auto && auto.value
    // frequency = frequency && frequency.value
    if (bvn === false) {
        return FunctionOne.flash("error", "You need to update your bvn to be able to perform this task")
    }
    if (target === '') {
        return FunctionOne.flash("error", "Please set a target you are saving towards")
    }
    if (!amount || amount === '') {
        return FunctionOne.flash("error", " Savings Amount is required")
    }
    if (amount < 500) {
        return FunctionOne.flash("error", "Minimum funding for Reapquick is ₦500")
    }

    if (duration === '') {
        return FunctionOne.flash("error", "Please select a savings duration")
    }
    if (auto === 1 || auto === '1') {
        if (frequency === 0 || frequency === '0') {
            return FunctionOne.flash("error", "Please select the frequency at which you want to be debited")
        }
    }

    let modalContent = {
        title: "Create New Saving's plan",
        message: "Your are about to create a new saving's plan",
        callToAction: 'Do you want to continue?',
        amount: amount,
        frequency: frequency === '1' ? 'Daily' : frequency === '7' ? 'Weekly' : frequency === '30' ? 'Monthly' : 'One time',
        payment: payment,
        howToSave: auto === '1' ? 'Auto' : 'Manual',
        target: target,
        duration: duration


    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedSavings = () => {

        if (payment === 'wallet') {
            if (auto === 1 || auto === '1') {
                return FunctionOne.flash("error", "Auto top up can not be perform from Wallet try using Card payment")

            }
            let formData = new FormData()
            formData.append('token', token)
            formData.append('plan_target', target)
            formData.append('saving_amount', amount)
            formData.append('auto_save', auto)
            formData.append('frequency', frequency)
            formData.append('duration', duration)
            formData.append('payment_method', payment)
            formData.append('savings_plan_id', 2)
            let sendData = {
                url: Apphelpers.url.StartReapquick,
                method: 'POST',
                body: formData
            }
            appState.loader = true
            appState.loader = ReducerAction.loader.Payment
            FunctionOne.updateAppState()
            Apphelpers.sendRequest(sendData, res => {
                appState.loader = false
                if (res.status === 'success') {
                    FunctionOne.flash("success", res.message)
                    setTimeout(() => {
                        window.location = '/savings/reapquick'
                    }, 4000)
                } else {

                    return FunctionOne.flash("error", res.message)
                }

            })

        } else {
            let auth = document.querySelector('.mPayment')
            let authorization = auth.selectedOptions[0].getAttribute('data-authorization')
            if (authorization !== null) {
                let formData = new FormData()
                formData.append('token', token)
                formData.append('plan_target', target)
                formData.append('saving_amount', amount)
                formData.append('auto_save', auto)
                formData.append('auto_save_duration', frequency)
                formData.append('duration', duration)
                formData.append('payment_method', payment)
                formData.append('savings_plan_id', 2)
                formData.append('authorization', authorization)
                let sendData = {
                    url: Apphelpers.url.StartReapquick,
                    method: 'POST',
                    body: formData
                }
                appState.loader = true
                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
                Apphelpers.sendRequest(sendData, res => {
                    appState.loader = false
                    if (res.status === 'success') {
                        FunctionOne.flash("success", res.message)
                        setTimeout(() => {
                            window.location = '/savings/reapquick'
                        }, 4000)
                    } else {

                        return FunctionOne.flash("error", res.message)
                    }

                })
            } else {
                appState.payment.start = true
                appState.payment.amount = amount
                appState.payment.auto = auto
                appState.payment.frequency = frequency
                appState.payment.duration = duration
                appState.payment.target = target
                appState.payment.payment = payment

                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
            }
        }

    }
}

FunctionOne.CompleteReapquickPayment = (e) => {
    let token = appState.userDetails.token
    let amount = appState.payment.amount
    let auto = appState.payment.auto
    let frequency = appState.payment.frequency
    let duration = appState.payment.duration
    let target = appState.payment.target
    let payment = appState.payment.payment
    let reference = e.reference
    let status = e.status

    if (status !== "success") {
        return FunctionOne.flash("error", "Sorry this transaction was not successful")
    }

    let formData = new FormData()
    formData.append('token', token)
    formData.append('saving_amount', amount)
    formData.append('auto_save', auto)
    formData.append('auto_save_duration', frequency)
    formData.append('transaction_code', reference)
    formData.append('plan_target', target)
    formData.append('duration', duration)
    formData.append('payment_method', 'paystack')
    formData.append('savings_plan_id', 2)
    formData.append('authorization', '')


    let sendData = {
        url: Apphelpers.url.StartReapquick,
        method: 'POST',
        body: formData
    }
    appState.payment.start = null
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {
            FunctionOne.getWallet()

            FunctionOne.flash("success", res.message)
            setTimeout(() => {
                window.location = '/savings/reapquick'
            }, 4000)

        } else {

            return FunctionOne.flash("error", res.message)
        }

    })

}

FunctionOne.singleSavings = (id) => {
    // let token = localStorage.getItem("_htoken")
    let token = appState.userDetails.token
    let savingsId = id

    let formData = new FormData()
    formData.append('token', token)
    formData.append('savings_id', savingsId)
    let sendData = {
        url: Apphelpers.url.SingleSavings,
        method: 'POST',
        body: formData
    }
    // console.log(sendData)
    Apphelpers.sendRequest(sendData, res => {
        if (res.status === 'error') {
            Apphistory.push('/savings')

            FunctionOne.updateAppState()
        }
        appState.result.singlesavings = res
        // console.log(res)
        // console.log(res.message)
        FunctionOne.updateAppState()
    })
}

FunctionOne.Breaksave = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    // let { amount, breakid, planid } = e.target.elements
    let amount = document.querySelector('.amount')
    let breakid = document.querySelector('.breakid')
    let planid = document.querySelector('.planid')
    amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    // console.log(amount)
    amount = parseInt(amount)
    // console.log(amount)
    // return
    breakid = breakid && breakid.value.trim()
    planid = planid && planid.value.trim()

    if (!amount || amount === '') {
        return FunctionOne.flash("error", "Breaking Amount is required")
    }
    if (amount < 500) {
        return FunctionOne.flash("error", "Sorry you cant break below ₦500")
    }
    let modalContent = {
        title: 'Break Savings',
        message: "Your are about to break this saving's plan. Not that 2% will be deducted from the break amount",
        callToAction: 'Do you want to continue?',
        amount: amount,
        break: amount - (amount * 0.02)

    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAuto2 = () => {

        let formData = new FormData()
        formData.append('token', token)
        formData.append('savings_id', breakid)
        formData.append('savings_plan_id', planid)
        formData.append('amount', amount)
        let sendData = {
            url: Apphelpers.url.Breaksave,
            method: 'POST',
            body: formData
        }
        appState.loader = true
        document.querySelector('.btnDisabled').disabled = true;
        FunctionOne.updateAppState()
        Apphelpers.sendRequest(sendData, res => {
            document.querySelector('.btnDisabled').disabled = false;
            appState.loader = false
            if (res.status === 'success') {

                return FunctionOne.flash("success", res.message)
            } else {

                return FunctionOne.flash("error", res.message)
            }

        })
    }
}

FunctionOne.Topupsave = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let email = appState.userDetails.email
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    // let { amount, auto, frequency, payment, planid } = e.target.elements
    let amount = document.querySelector('.amount')
    let auto = document.querySelector('.auto')
    let frequency = document.querySelector('.frequency')
    let planid = document.querySelector('.planid')
    let auth = document.querySelector('.mPayment')
    let payment = auth.selectedOptions[0].value
    amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    amount = parseInt(amount)
    // payment = payment && payment.value.trim()
    auto = auto && auto.value
    frequency = frequency && frequency.value
    planid = planid && planid.value

    if (!amount || amount === '') {
        return FunctionOne.flash("error", " Topup Amount is required")
    }
    if (amount < 500) {
        return FunctionOne.flash("error", " Topup Minimum funding amount is ₦500")
    }

    if (auto === 1 || auto === '1') {
        if (frequency === 0 || frequency === '0') {
            return FunctionOne.flash("error", "Please select the frequency at which you want to be debited")
        }
    }
    let modalContent = {
        title: 'Savings Quick topup',
        message: "Your are about to topup this saving's account",
        callToAction: 'Do you want to continue?',
        amount: amount,
        payment: payment

    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAuto2 = () => {

        if (payment === 'wallet') {
            if (auto === 1 || auto === '1') {
                return FunctionOne.flash("error", "Auto top up can not be perform from Wallet try using Card payment")

            }
            let formData = new FormData()
            formData.append('token', token)
            formData.append('saving_amount', amount)
            formData.append('auto_save', auto)
            formData.append('payment_method', payment)
            formData.append('savings_investment_id', planid)
            let sendData = {
                url: Apphelpers.url.Topupsave,
                method: 'POST',
                body: formData
            }
            appState.loader = true
            appState.loader = ReducerAction.loader.Payment
            FunctionOne.updateAppState()
            Apphelpers.sendRequest(sendData, res => {
                appState.loader = false
                if (res.status === 'success') {
                    FunctionOne.singleSavings(planid)
                    return FunctionOne.flash("success", res.message)
                    // setTimeout(() => {
                    //     window.location.reload()
                    // }, 4000)
                } else {

                    return FunctionOne.flash("error", res.message)
                }

            })

        } else {
            // let auth = document.querySelector('.mPayment')
            let authorization = auth.selectedOptions[0].getAttribute('data-authorization')
            if (authorization && authorization !== null) {
                let formData = new FormData()
                formData.append('token', token)
                formData.append('saving_amount', amount)
                formData.append('auto_save', auto)
                formData.append('auto_save_duration', frequency)
                formData.append('payment_method', payment)
                formData.append('savings_investment_id', planid)
                formData.append('authorization', authorization)
                let sendData = {
                    url: Apphelpers.url.Topupsave,
                    method: 'POST',
                    body: formData
                }
                appState.loader = true
                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
                Apphelpers.sendRequest(sendData, res => {
                    appState.loader = false
                    if (res.status === 'success') {
                        FunctionOne.singleSavings(planid)
                        return FunctionOne.flash("success", res.message)
                        // setTimeout(() => {
                        //     window.location.reload()
                        // }, 4000)
                    } else {

                        return FunctionOne.flash("error", res.message)
                    }

                })
            } else {
                appState.payment.start = true
                appState.payment.amount = amount
                appState.payment.auto = auto
                appState.payment.frequency = frequency
                appState.payment.planid = planid
                appState.payment.payment = payment

                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
            }
        }
    }

}
FunctionOne.Topupsave2 = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let email = appState.userDetails.email
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    // let { amount, auto, frequency, payment, planid } = e.target.elements
    let amount = document.querySelector('.amount')
    let auto = document.querySelector('.auto')
    let frequency1 = document.querySelector('.frequency')
    let planid = document.querySelector('.planid')
    let auth = document.querySelector('.mPayment')
    let payment = auth.selectedOptions[0].value
    let frequency = frequency1.selectedOptions[0].value
    amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    amount = parseInt(amount)
    // payment = payment && payment.value.trim()
    auto = auto && auto.value

    planid = planid && planid.value

    if (!amount || amount === '') {
        return FunctionOne.flash("error", " Topup Amount is required")
    }
    if (amount < 500) {
        return FunctionOne.flash("error", " Topup Minimum funding amount is ₦500")
    }

    if (auto === 1 || auto === '1') {
        if (frequency === 0 || frequency === '0') {
            return FunctionOne.flash("error", "Please select the frequency at which you want to be debited")
        }
    }

    let modalContent = {
        title: 'Start Auto Savings',
        message: 'Your are about to start Auto debit on this Savings. Please note that, Reaprite will have Authorization to debit your bank account on your behalf',
        callToAction: 'Do you want to continue?',
        amount: amount,
        duration: frequency === '1' ? 'Daily' : frequency === '7' ? 'Weekly' : frequency === '30' ? 'Monthly' : ''

    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedAuto = () => {

        if (payment === 'wallet') {
            if (auto === 1 || auto === '1') {
                return FunctionOne.flash("error", "Auto top up can not be perform from Wallet try using Card payment")

            }
            let formData = new FormData()
            formData.append('token', token)
            formData.append('saving_amount', amount)
            formData.append('auto_save', auto)
            formData.append('payment_method', payment)
            formData.append('savings_investment_id', planid)
            let sendData = {
                url: Apphelpers.url.Topupsave,
                method: 'POST',
                body: formData
            }
            appState.loader = true
            appState.loader = ReducerAction.loader.Payment
            FunctionOne.updateAppState()
            Apphelpers.sendRequest(sendData, res => {
                appState.loader = false
                if (res.status === 'success') {
                    FunctionOne.singleSavings(planid)
                    return FunctionOne.flash("success", res.message)
                    // setTimeout(() => {
                    //     window.location.reload()
                    // }, 4000)
                } else {

                    return FunctionOne.flash("error", res.message)
                }

            })

        } else {
            let auth = document.querySelector('.mPayment')
            let authorization = auth.selectedOptions[0].getAttribute('data-authorization')
            if (payment === 'paystack' && authorization !== null) {
                let formData = new FormData()
                formData.append('token', token)
                formData.append('saving_amount', amount)
                formData.append('auto_save', auto)
                formData.append('auto_save_duration', frequency)
                formData.append('payment_method', payment)
                formData.append('savings_investment_id', planid)
                formData.append('authorization', authorization)
                let sendData = {
                    url: Apphelpers.url.Topupsave,
                    method: 'POST',
                    body: formData
                }
                appState.loader = true
                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
                Apphelpers.sendRequest(sendData, res => {
                    appState.loader = false
                    if (res.status === 'success') {
                        FunctionOne.singleSavings(planid)
                        return FunctionOne.flash("success", res.message)

                    } else {

                        return FunctionOne.flash("error", res.message)
                    }

                })
            } else {
                appState.payment.start = true
                appState.payment.amount = amount
                appState.payment.auto = auto
                appState.payment.frequency = frequency
                appState.payment.planid = planid
                appState.payment.payment = payment

                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
            }
        }
    }


}

FunctionOne.CompleteTopupsave = (e) => {
    let token = appState.userDetails.token
    let amount = appState.payment.amount
    let auto = appState.payment.auto
    let frequency = appState.payment.frequency
    let planid = appState.payment.planid
    let payment = appState.payment.payment
    let reference = e.reference
    let status = e.status

    if (status !== "success") {
        return FunctionOne.flash("error", "Sorry this transaction was not successful")
    }

    let formData = new FormData()
    formData.append('token', token)
    formData.append('saving_amount', amount)
    formData.append('auto_save', auto)
    formData.append('auto_save_duration', frequency)
    formData.append('transaction_code', reference)
    formData.append('payment_method', 'paystack')
    formData.append('savings_investment_id', planid)
    formData.append('authorization', '')


    let sendData = {
        url: Apphelpers.url.Topupsave,
        method: 'POST',
        body: formData
    }
    appState.payment.start = null
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {
            FunctionOne.singleSavings(planid)
            return FunctionOne.flash("success", res.message)
            // setTimeout(() => {
            //     window.location = '/savings/reapquick'
            // }, 4000)

        } else {

            return FunctionOne.flash("error", res.message)
        }

    })

}

//section for reapplus

FunctionOne.RegisterReapplus = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let bvn = appState.userDetails.user_bvn
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    // let { amount, auto, frequency, target, duration, payment } = e.target.elements
    let target = document.querySelector('.target')
    let amount = document.querySelector('.amount')
    let auto1 = document.querySelector('.auto')
    let auth = document.querySelector('.mPayment')
    let payment = auth.selectedOptions[0].value
    let frequency1 = document.querySelector('.frequency')
    let frequency = frequency1.selectedOptions[0].value
    let duration1 = document.querySelector('.duration')
    let duration = duration1.selectedOptions[0].value
    let auto = auto1.selectedOptions[0].value
    amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    amount = parseInt(amount)
    target = target && target.value.trim()
    target = target.replace(/\,/g, '')
    target = target.replace(/\₦/g, '')
    target = parseInt(target)
    // payment = payment && payment.value.trim()
    // duration = duration && duration.value.trim()
    // auto = auto && auto.value
    // frequency = frequency && frequency.value
    if (bvn === false) {
        return FunctionOne.flash("error", "You need to update your bvn to be able to perform this task")
    }
    if (target === '') {
        return FunctionOne.flash("error", "Please set a target you are saving towards")
    }
    if (!amount || amount === '') {
        return FunctionOne.flash("error", " Savings Amount is required")
    }
    if (amount < 100000) {
        return FunctionOne.flash("error", "Minimum funding for Reapplus is ₦100,000")
    }

    if (duration === '') {
        return FunctionOne.flash("error", "Please select a savings duration")
    }
    if (auto === 1 || auto === '1') {
        if (frequency === 0 || frequency === '0') {
            return FunctionOne.flash("error", "Please select the frequency at which you want to be debited")
        }
    }

    let modalContent = {
        title: "Create Reap plus Saving's plan",
        message: "Your are about to create a new saving's plan",
        callToAction: 'Do you want to continue?',
        amount: amount,
        frequency: frequency === '1' ? 'Daily' : frequency === '7' ? 'Weekly' : frequency === '30' ? 'Monthly' : 'One time',
        payment: payment,
        howToSave: auto === '1' ? 'Auto' : 'Manual',
        target: target,
        duration: duration


    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedSavings = () => {

        if (payment === 'wallet') {
            if (auto === 1 || auto === '1') {
                return FunctionOne.flash("error", "Auto top up can not be perform from Wallet try using Card payment")

            }
            let formData = new FormData()
            formData.append('token', token)
            formData.append('plan_target', target)
            formData.append('saving_amount', amount)
            formData.append('auto_save', auto)
            formData.append('auto_save_duration', frequency)
            formData.append('duration', duration)
            formData.append('payment_method', payment)
            formData.append('savings_plan_id', 3)
            let sendData = {
                url: Apphelpers.url.StartReapplus,
                method: 'POST',
                body: formData
            }
            appState.loader = true
            appState.loader = ReducerAction.loader.Payment
            FunctionOne.updateAppState()
            Apphelpers.sendRequest(sendData, res => {
                appState.loader = false
                if (res.status === 'success') {
                    FunctionOne.flash("success", res.message)
                    setTimeout(() => {
                        window.location = '/savings/reapplus'
                    }, 4000)
                } else {

                    return FunctionOne.flash("error", res.message)
                }

            })

        } else {
            let auth = document.querySelector('.mPayment')
            let authorization = auth.selectedOptions[0].getAttribute('data-authorization')
            if (authorization !== null) {
                let formData = new FormData()
                formData.append('token', token)
                formData.append('plan_target', target)
                formData.append('saving_amount', amount)
                formData.append('auto_save', auto)
                formData.append('auto_save_duration', frequency)
                formData.append('duration', duration)
                formData.append('payment_method', payment)
                formData.append('savings_plan_id', 3)
                formData.append('authorization', authorization)
                let sendData = {
                    url: Apphelpers.url.StartReapplus,
                    method: 'POST',
                    body: formData
                }
                appState.loader = true
                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
                Apphelpers.sendRequest(sendData, res => {
                    appState.loader = false
                    if (res.status === 'success') {
                        FunctionOne.flash("success", res.message)
                        setTimeout(() => {
                            window.location = '/savings/reapplus'
                        }, 4000)
                    } else {

                        return FunctionOne.flash("error", res.message)
                    }

                })
            } else {
                appState.payment.start = true
                appState.payment.amount = amount
                appState.payment.auto = auto
                appState.payment.frequency = frequency
                appState.payment.duration = duration
                appState.payment.target = target
                appState.payment.payment = payment

                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
            }
        }
    }

}

FunctionOne.CompleteReapplusPayment = (e) => {
    let token = appState.userDetails.token
    let amount = appState.payment.amount
    let auto = appState.payment.auto
    let frequency = appState.payment.frequency
    let duration = appState.payment.duration
    let target = appState.payment.target
    let payment = appState.payment.payment
    let reference = e.reference
    let status = e.status

    if (status !== "success") {
        return FunctionOne.flash("error", "Sorry this transaction was not successful")
    }

    let formData = new FormData()
    formData.append('token', token)
    formData.append('saving_amount', amount)
    formData.append('auto_save', auto)
    formData.append('auto_save_duration', frequency)
    formData.append('transaction_code', reference)
    formData.append('plan_target', target)
    formData.append('duration', duration)
    formData.append('payment_method', 'paystack')
    formData.append('savings_plan_id', 3)
    formData.append('authorization', '')


    let sendData = {
        url: Apphelpers.url.StartReapplus,
        method: 'POST',
        body: formData
    }
    appState.payment.start = null
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {
            FunctionOne.getWallet()

            FunctionOne.flash("success", res.message)
            setTimeout(() => {
                window.location = '/savings/reapplus'
            }, 4000)

        } else {

            return FunctionOne.flash("error", res.message)
        }

    })

}

//section for reapmax
FunctionOne.RegisterReapmax = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let bvn = appState.userDetails.user_bvn
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    // let { amount, auto, frequency, target, duration, payment } = e.target.elements
    let target = document.querySelector('.target')
    let amount = document.querySelector('.amount')
    let auto1 = document.querySelector('.auto')
    let auth = document.querySelector('.mPayment')
    let payment = auth.selectedOptions[0].value
    let frequency1 = document.querySelector('.frequency')
    let frequency = frequency1.selectedOptions[0].value
    let duration1 = document.querySelector('.duration')
    let duration = duration1.selectedOptions[0].value
    let auto = auto1.selectedOptions[0].value
    amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    amount = parseInt(amount)
    target = target && target.value.trim()
    target = target.replace(/\,/g, '')
    target = target.replace(/\₦/g, '')
    target = parseInt(target)
    // payment = payment && payment.value.trim()
    // duration = duration && duration.value.trim()
    // auto = auto && auto.value
    // frequency = frequency && frequency.value
    if (bvn === false) {
        return FunctionOne.flash("error", "You need to update your bvn to be able to perform this task")
    }
    if (target === '') {
        return FunctionOne.flash("error", "Please set a target you are saving towards")
    }
    if (!amount || amount === '') {
        return FunctionOne.flash("error", " Savings Amount is required")
    }
    if (amount < 10000) {
        return FunctionOne.flash("error", "Minimum funding for Reapmax is ₦1,000,000")
    }

    if (duration === '') {
        return FunctionOne.flash("error", "Please select a savings duration")
    }
    if (auto === 1 || auto === '1') {
        if (frequency === 0 || frequency === '0') {
            return FunctionOne.flash("error", "Please select the frequency at which you want to be debited")
        }
    }

    let modalContent = {
        title: "Create Reap max Saving's plan",
        message: "Your are about to create a new saving's plan",
        callToAction: 'Do you want to continue?',
        amount: amount,
        frequency: frequency === '1' ? 'Daily' : frequency === '7' ? 'Weekly' : frequency === '30' ? 'Monthly' : 'One time',
        payment: payment,
        howToSave: auto === '1' ? 'Auto' : 'Manual',
        target: target,
        duration: duration


    }

    appState.modal = {}
    appState.modal.show = true
    appState.modal.data = modalContent
    FunctionOne.updateAppState()
    FunctionOne.ProceedSavings = () => {

        if (payment === 'wallet') {
            if (auto === 1 || auto === '1') {
                return FunctionOne.flash("error", "Auto top up can not be perform from Wallet try using Card payment")

            }
            let formData = new FormData()
            formData.append('token', token)
            formData.append('plan_target', target)
            formData.append('saving_amount', amount)
            formData.append('auto_save', auto)
            formData.append('auto_save_duration', frequency)
            formData.append('duration', duration)
            formData.append('payment_method', payment)
            formData.append('savings_plan_id', 4)
            let sendData = {
                url: Apphelpers.url.StartReapmax,
                method: 'POST',
                body: formData
            }
            appState.loader = true
            appState.loader = ReducerAction.loader.Payment
            FunctionOne.updateAppState()
            Apphelpers.sendRequest(sendData, res => {
                appState.loader = false
                if (res.status === 'success') {
                    FunctionOne.flash("success", res.message)
                    setTimeout(() => {
                        window.location = '/savings/reapmax'
                    }, 4000)
                } else {

                    return FunctionOne.flash("error", res.message)
                }

            })

        } else {
            let auth = document.querySelector('.mPayment')
            let authorization = auth.selectedOptions[0].getAttribute('data-authorization')
            if (authorization && authorization !== null) {
                let formData = new FormData()
                formData.append('token', token)
                formData.append('plan_target', target)
                formData.append('saving_amount', amount)
                formData.append('auto_save', auto)
                formData.append('frequency', frequency)
                formData.append('duration', duration)
                formData.append('payment_method', payment)
                formData.append('savings_plan_id', 4)
                formData.append('authorization', authorization)
                let sendData = {
                    url: Apphelpers.url.StartReapmax,
                    method: 'POST',
                    body: formData
                }
                appState.loader = true
                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
                Apphelpers.sendRequest(sendData, res => {
                    appState.loader = false
                    if (res.status === 'success') {
                        FunctionOne.flash("success", res.message)
                        setTimeout(() => {
                            window.location = '/savings/reapmax'
                        }, 4000)
                    } else {

                        return FunctionOne.flash("error", res.message)
                    }

                })
            } else {
                appState.payment.start = true
                appState.payment.amount = amount
                appState.payment.auto = auto
                appState.payment.frequency = frequency
                appState.payment.duration = duration
                appState.payment.target = target
                appState.payment.payment = payment

                appState.loader = ReducerAction.loader.Payment
                FunctionOne.updateAppState()
            }
        }
    }

}

FunctionOne.CompleteReapmaxPayment = (e) => {
    let token = appState.userDetails.token
    let amount = appState.payment.amount
    let auto = appState.payment.auto
    let frequency = appState.payment.frequency
    let duration = appState.payment.duration
    let target = appState.payment.target
    let payment = appState.payment.payment
    let reference = e.reference
    let status = e.status

    if (status !== "success") {
        return FunctionOne.flash("error", "Sorry this transaction was not successful")
    }

    let formData = new FormData()
    formData.append('token', token)
    formData.append('saving_amount', amount)
    formData.append('auto_save', auto)
    formData.append('auto_save_duration', frequency)
    formData.append('transaction_code', reference)
    formData.append('plan_target', target)
    formData.append('duration', duration)
    formData.append('payment_method', 'paystack')
    formData.append('savings_plan_id', 4)
    formData.append('authorization', '')


    let sendData = {
        url: Apphelpers.url.StartReapmax,
        method: 'POST',
        body: formData
    }
    appState.payment.start = null
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {
            FunctionOne.getWallet()

            FunctionOne.flash("success", res.message)
            setTimeout(() => {
                window.location = '/savings/reapmax'
            }, 4000)

        } else {

            return FunctionOne.flash("error", res.message)
        }

    })

}

FunctionOne.handleReapplusMoney = (e) => {
    let amount = e.target.value
    // amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    let durations = document.querySelector('.duration').value
    // console.log(durations)
    let percent = 0
    if (durations === 12 || durations === '12') {
        percent = 14
    } else if (durations === 9 || durations === '9') {
        percent = 13.25
    } else {
        percent = 12.5
    }
    let cal = (((percent / 100) * amount) / 12) * parseInt(durations) + parseInt(amount)

    document.querySelector('.returns').textContent = 'Returns in ' + durations + ' months ' + FunctionOne.MoneyFormat(cal)

}
FunctionOne.handleReapplusMonth = (e) => {
    let durations = e.target.value
    let amount = document.querySelector('.money').value
    // amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    // console.log(durations)
    // console.log(amount)
    let percent = 0
    if (durations === 12 || durations === '12') {
        percent = 14
    } else if (durations === 9 || durations === '9') {
        percent = 13.25
    } else {
        percent = 12.5
    }
    let cal = (((percent / 100) * amount) / 12) * parseInt(durations) + parseInt(amount)

    document.querySelector('.returns').textContent = 'Returns in ' + durations + ' months ' + FunctionOne.MoneyFormat(cal)

}
FunctionOne.handleReapquickMoney = (e) => {
    let amount = e.target.value
    // amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    let durations = document.querySelector('.duration').value
    // console.log(durations)
    let percent = 0
    if (durations === 12 || durations === '12') {
        percent = 12.5
    } else if (durations === 9 || durations === '9') {
        percent = 12.32
    } else if (durations === 6 || durations === '6') {
        // percent = 20
        percent = 12.16
    } else {
        percent = 12
    }

    let rate = 12
    if (percent === 20) {
        rate = 10
    } else {
        rate = percent
    }
    let cal = (((percent / 100) * amount) / 12) * parseInt(durations) + parseInt(amount)

    document.querySelector('.returns').textContent = 'Returns in ' + durations + ' months ' + FunctionOne.MoneyFormat(cal)
    document.querySelector('.mPercent').textContent = 'Rate: ' + rate + '%'
}
FunctionOne.handleReapquickMonth = (e) => {
    let durations = e.target.value
    let amount = document.querySelector('.money').value
    // amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    // console.log(durations)
    // console.log(amount)
    let percent = 0
    if (durations === 12 || durations === '12') {
        percent = 12.5
    } else if (durations === 9 || durations === '9') {
        percent = 12.32
    } else if (durations === 6 || durations === '6') {
        // percent = 20
        percent = 12.16
    } else {
        percent = 12
    }
    let rate = 12
    if (percent === 20) {
        rate = 10
    } else {
        rate = percent
    }
    let cal = (((percent / 100) * amount) / 12) * parseInt(durations) + parseInt(amount)

    document.querySelector('.returns').textContent = 'Returns in ' + durations + ' months ' + FunctionOne.MoneyFormat(cal)
    document.querySelector('.mPercent').textContent = 'Rate: ' + rate + '%'
}
FunctionOne.handleReapmaxMoney = (e) => {
    let amount = e.target.value
    // amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    amount = parseInt(amount)
    let durations = document.querySelector('.duration').value
    // console.log(durations)
    let percent = 0
    if (durations === 12 || durations === '12') {
        percent = 16
    } else {
        percent = 14
    }
    let cal = (((percent / 100) * amount) / 12) * parseInt(durations) + parseInt(amount)

    document.querySelector('.returns').textContent = 'Returns in ' + durations + ' months ' + FunctionOne.MoneyFormat(cal)

}
FunctionOne.handleWithdrawalMoney = (e) => {
    let amount = e.target.value
    // console.log(amount)
    // amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')


    document.querySelector('.returns').textContent = 'Amount ' + FunctionOne.MoneyFormat(parseInt(amount))

}
FunctionOne.handleReapmaxMonth = (e) => {
    let durations = e.target.value
    let amount = document.querySelector('.money').value
    // amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    amount = parseInt(amount)
    // console.log(durations)
    // console.log(amount)
    let percent = 0
    if (durations === 12 || durations === '12') {
        percent = 16
    } else {
        percent = 14
    }
    let cal = (((percent / 100) * amount) / 12) * parseInt(durations) + parseInt(amount)

    document.querySelector('.returns').textContent = 'Returns in ' + durations + ' months ' + FunctionOne.MoneyFormat(cal)

}
FunctionOne.handleInvestment = (e) => {
    let units = e.target.value
    let amount = document.querySelector('.money').value
    let percent = document.querySelector('.percent').value
    let availableunits = document.querySelector('.availableunits').value

    if (units < 1) {
        document.querySelector('.availableunits').value = 1
    }
    if (units > availableunits) {
        document.querySelector('.availableunits').value = availableunits
    }
    let pay = parseInt(amount) * parseInt(units)
    let cal = ((percent / 100) * pay) + parseInt(pay)

    document.querySelector('.returns').textContent = FunctionOne.numberFormat(cal)

    document.querySelector('.topay').value = '₦' + FunctionOne.numberFormat(pay)

}
FunctionOne.ProcessAmount = (e) => {
    let amount = e.target.value
    // amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    // console.log(e)
    document.querySelector('.returns').textContent = 'Withdrawal Amount: ' + FunctionOne.MoneyFormat(parseInt(amount))
}
FunctionOne.ProcessWalletTop = (e) => {
    let amount = e.target.value
    // amount = amount && amount.value.trim()
    amount = amount.replace(/\,/g, '')
    amount = amount.replace(/\₦/g, '')
    // console.log(e)
    document.querySelector('.returns').textContent = 'Amount: ' + FunctionOne.MoneyFormat(parseInt(amount))
}

FunctionOne.RegisterInvestment = (e) => {
    e.preventDefault()
    let token = appState.userDetails.token
    let bvn = appState.userDetails.user_bvn
    let emailStatus = appState.userDetails.all.verify
    if (emailStatus === '0') {
        return FunctionOne.flash("error", "You need to verify your email address, Click on the notification on your dashboard to verify your email")
    }
    let { amount, payment, unitnumber, investmentid, unitprice } = e.target.elements

    payment = payment && payment.value.trim()
    investmentid = investmentid && investmentid.value.trim()
    unitnumber = unitnumber && unitnumber.value.trim()
    unitprice = unitprice && unitprice.value.trim()
    amount = parseInt(unitprice) * parseInt(unitnumber)
    // amount = amount.replace(/\,/g, '')
    // amount = amount.replace(/\₦/g, '')

    if (bvn === false) {
        return FunctionOne.flash("error", "You need to update your bvn to be able to perform this task")
    }

    if (!amount || amount === '') {
        return FunctionOne.flash("error", "Amount is required")
    }

    if (payment === 'wallet') {

        let formData = new FormData()
        formData.append('token', token)
        formData.append('amount', amount)
        formData.append('unit', unitnumber)
        formData.append('investment_id', investmentid)
        formData.append('payment_method', payment)
        let sendData = {
            url: Apphelpers.url.StartInvestment,
            method: 'POST',
            body: formData
        }
        appState.loader = true
        appState.loader = ReducerAction.loader.Payment
        FunctionOne.updateAppState()
        Apphelpers.sendRequest(sendData, res => {
            appState.loader = false
            if (res.status === 'success') {
                FunctionOne.flash("success", res.message)
                setTimeout(() => {
                    window.location = '/investments'
                }, 4000)
            } else {

                return FunctionOne.flash("error", res.message)
            }

        })

    } else {
        let auth = document.querySelector('.mPayment')
        let authorization = auth.selectedOptions[0].getAttribute('data-authorization')
        if (authorization !== null) {
            let formData = new FormData()
            formData.append('token', token)
            formData.append('amount', amount)
            formData.append('unit', unitnumber)
            formData.append('investment_id', investmentid)
            formData.append('payment_method', payment)
            formData.append('authorization', authorization)
            let sendData = {
                url: Apphelpers.url.StartInvestment,
                method: 'POST',
                body: formData
            }
            appState.loader = true
            appState.loader = ReducerAction.loader.Payment
            FunctionOne.updateAppState()
            Apphelpers.sendRequest(sendData, res => {
                appState.loader = false
                if (res.status === 'success') {
                    FunctionOne.flash("success", res.message)
                    setTimeout(() => {
                        window.location = '/investments'
                    }, 4000)
                } else {

                    return FunctionOne.flash("error", res.message)
                }

            })
        } else {

            appState.payment.start = true
            appState.payment.amount = amount
            appState.payment.payment = payment
            appState.payment.unitnumber = unitnumber
            appState.payment.investmentid = investmentid

            appState.loader = ReducerAction.loader.Payment
            FunctionOne.updateAppState()
        }
    }


}

FunctionOne.CompleteInvestmentPayment = (e) => {
    let token = appState.userDetails.token
    let amount = appState.payment.amount
    let unitnumber = appState.payment.unitnumber
    let investmentid = appState.payment.investmentid
    let payment = appState.payment.payment
    let reference = e.reference
    let status = e.status

    if (status !== "success") {
        return FunctionOne.flash("error", "Sorry this transaction was not successful")
    }

    let formData = new FormData()
    formData.append('token', token)
    formData.append('amount', amount)
    formData.append('unit', unitnumber)
    formData.append('investment_id', investmentid)
    // formData.append('payment_method', payment)
    formData.append('payment_method', 'paystack')
    formData.append('transaction_code', reference)
    formData.append('authorization', '')


    let sendData = {
        url: Apphelpers.url.StartInvestment,
        method: 'POST',
        body: formData
    }
    appState.payment.start = null
    FunctionOne.updateAppState()
    Apphelpers.sendRequest(sendData, res => {
        appState.loader = false
        if (res.status === 'success') {
            FunctionOne.getWallet()

            FunctionOne.flash("success", res.message)
            setTimeout(() => {
                window.location = '/investments'
            }, 4000)

        } else {

            return FunctionOne.flash("error", res.message)
        }

    })

}

FunctionOne.MoneyFormat = (money) => {
    return '₦' + (money).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

FunctionOne.closedModal = () => {
    appState.modal = {}
    appState.modal.show = false
    appState.modal.data = null
    FunctionOne.updateAppState()
}

FunctionOne.numberFormat = (value) =>

    new Intl.NumberFormat().format(value);


export default FunctionOne
