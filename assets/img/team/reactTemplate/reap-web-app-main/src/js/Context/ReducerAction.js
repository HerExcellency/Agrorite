const ReducerAction = {}
ReducerAction.error = 'There_is_an_error'
ReducerAction.updateAppstate = 'Update_my_state'



ReducerAction.result = {}
ReducerAction.result.userActivity = "show_user_activity"
ReducerAction.result.savingActivity = "show_saving_activity"
ReducerAction.result.Wallet = "show_user_wallet"

ReducerAction.loader = {}
ReducerAction.loader.ConfirmAccount = 'confirm_account'
ReducerAction.loader.Payment = 'confirm_payment'
ReducerAction.loader.Refer = 'confirm_referral'
ReducerAction.loader.Cards = 'delete_cards'
// ReducerAction.modal.Autoset = 'set_auto_refer_modal'

ReducerAction.screen = {}
ReducerAction.screen.Portfolioinvest = 'portfolio_investments'
ReducerAction.screen.PaidReapTarget = 'portfolio_target_save'
ReducerAction.screen.updateBVN = 'update_user_bvn'
ReducerAction.screen.Verifyemail = 'verify_user_email'
ReducerAction.screen.updateBank = 'update_user_bank'
ReducerAction.screen.NextOfKins = 'update_user_nok'
ReducerAction.screen.UpdatePassword = 'update_user_password'
ReducerAction.screen.Withdrawal = 'withdraw_from_wallet'
ReducerAction.screen.Referral = 'User_referral'
ReducerAction.screen.Debit = 'User_debit'
ReducerAction.screen.Card = 'User_card'
ReducerAction.screen.Bank = 'User_bank'
ReducerAction.screen.Fundwallet = 'Fundwallet'
ReducerAction.screen.Topupsave = 'Top_up_savings'
ReducerAction.screen.Autodebit = 'Set_Auto_debit_savings'
ReducerAction.screen.Offautodebit = 'Set_Auto_debit_to_off_savings'

ReducerAction.screen.Autodebitwallet = 'Set_Auto_debit_wallet'
ReducerAction.screen.Stopautodebitwallet = 'Set_Auto_debit_to_off_wallet'

ReducerAction.screen.SavingsActivity = 'Savings_activity'
ReducerAction.screen.Breaksave = 'Break_savings'

ReducerAction.screen.RedeemInterest = 'redeem_interest'

ReducerAction.screen.Agriculture = 'agriculture_investment'
ReducerAction.screen.Paidinvestment = 'paid_investment'
ReducerAction.screen.Singleinvestment = 'single_investment'
ReducerAction.screen.UserSingleinvestment = 'user_single_investment'


//target settings
ReducerAction.screen.Topuptargetsave = 'Top_up_target_savings'
ReducerAction.screen.Autotargetdebit = 'Set_target_Auto_debit_savings'
ReducerAction.screen.Offtargetautodebit = 'Set_Auto_debit_to_off_target'
ReducerAction.screen.Ontargetautotopup = 'Set_Auto_debit_to_on_target'
ReducerAction.screen.Breaktargetsave = 'Break_target_savings'
ReducerAction.screen.Targetpaymentoption = 'payment_option_target_savings'

//village settings
ReducerAction.screen.Topupvillage = 'Top_up_village_savings'
ReducerAction.screen.Autovillagedebit = 'Set_village_Auto_debit_savings'
ReducerAction.screen.Offvillageautodebit = 'Set_Auto_debit_to_off_village'
ReducerAction.screen.Breakvillage = 'Break_village_savings'
ReducerAction.screen.Allvillage = 'All_village_savings'
ReducerAction.screen.Closedvillage = 'Closed_village_savings'
ReducerAction.screen.Villagesettings = 'settings_village_savings'
ReducerAction.screen.Villageactivity = 'activity_village_savings'
ReducerAction.screen.Setvillagepayment = 'village_savings_payment'
ReducerAction.screen.Sharevillage = 'village_savings_sharing'

export default ReducerAction;