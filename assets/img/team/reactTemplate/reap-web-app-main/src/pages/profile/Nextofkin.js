import React from 'react';
import AppContext from '../../js/Context/State';
import FunctionOne from '../../js/FunctionOne';
import { Flashmessage } from '../Components';
const Nextofkin = ({ nok }) => {
    let userState = React.useContext(AppContext).state
    let nexter = nok.all

    return (
        <div className="card">
            <div className="card-header d-flex justify-content-between">
                <div className="header-title">
                    <h4 className="card-title">Next of Kin</h4>
                </div>
            </div>
            <div className="card-body">
                <Flashmessage status={userState.error.type} msg={userState.error.message} />
                <form onSubmit={FunctionOne.ProcessNok}>
                    <div className="form-row">
                        <div className="col-md-6 mb-3">
                            <div className="form-group">
                                <input type="text" className="form-control" name="fullname" defaultValue={nexter?.kin_name} placeholder="fullname" />
                            </div>
                        </div>
                        <div className="col-md-6 mb-3">
                            <div className="form-group">
                                <input type="text" className="form-control" name="email" defaultValue={nexter?.kin_email} placeholder="email" />
                            </div>
                        </div>
                        <div className="col-md-6">
                            <div className="form-group">
                                <input type="text" className="form-control" name="mobile" defaultValue={nexter?.kin_phone} placeholder="mobile number" />
                            </div>
                        </div>
                        <div className="col-md-6">
                            <div className="form-group">
                                <input type="text" className="form-control" name="relationship" defaultValue={nexter?.relationship} placeholder="relationship: e.g Brother" />
                            </div>
                        </div>
                    </div>
                    <div className="form-group">
                        <input type="password" className="form-control" name="password" placeholder="Your Reaprite password" />
                    </div>
                    <button type="submit" className="btn btn-primary">{userState.loader ? 'Loading...' : 'Update'}</button>
                </form>
            </div>
        </div>
    );
}
export default Nextofkin;