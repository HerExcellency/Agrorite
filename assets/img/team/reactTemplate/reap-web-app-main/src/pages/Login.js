import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import AppContext from '../js/Context/State';
// import Refer from '../images/Refer.jpg';
import Saver from '../images/Saver.jpg';
import logo from '../images/nlogo.png';
import FunctionOne from '../js/FunctionOne';
import { Flashmessage } from './Components';
import Apple from '../images/apple.png';
import Play from '../images/play.png';
// import Easter from '../images/Easter.jpg';

const Login = () => {
    let userState = React.useContext(AppContext).state
    useEffect(() => {
        document.title = 'Login - Reaprite Global'
        FunctionOne.Checkers('/dashboard')
    }, [])

    const [passwordShown, setPasswordShown] = useState(false);
    const togglePasswordVisiblity = () => {
        setPasswordShown(passwordShown ? false : true);
    };

    return (
        <div className="wrapper">
            <section className="login-content">
                <div className="container h-100">
                    <a href="//reaprite.com" className="header-logo">
                        <img style={{ marginTop: '50px', marginBottom: '-20px', width: '125px' }} src={logo}
                            className="img-fluid rounded-normal" alt="logo" />
                    </a>
                    <div className="row align-items-center justify-content-center h-100" style={{ marginTop: '40px' }}>
                        <div className="col-12">
                            <div className="row">
                                <div className="col-lg-6 mb-4 mt-4" style={{ marginTop: '50px' }}>
                                    <h2 style={{ marginTop: '-25px' }}>Welcome back,</h2>
                                    <h3>Please sign in to continue</h3>
                                    <img className="mt-3" src={Saver} alt="Save for a loved one" />
                                    <div className="row mt-3">
                                        <div className="col-12">
                                            <h3>Download our Mobile App</h3>

                                        </div>
                                        <div className="col-4 col-lg-3">
                                            <div className="card card-block card-stretch card-height">
                                                <div className="card-body iq-total-content" style={{ padding: '0px' }}>
                                                    <a href="https://play.google.com/store/apps/details?id=com.reaprite.reaprite" target="_blank"><img src={Play} alt="" /></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div className="col-4 col-lg-3">
                                            <div className="card card-block card-stretch card-height">
                                                <div className="card-body iq-total-content" style={{ padding: '0px' }}>
                                                    <a href="https://apps.apple.com/ng/app/reaprite/id1552189378" target="_blank"><img src={Apple} alt="" /></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-lg-6">
                                    <h2 className="mb-2">Sign In</h2>
                                    <p>Enter your login details below</p>
                                    <Flashmessage status={userState.error.type} msg={userState.error.message} />
                                    <form onSubmit={FunctionOne.ProcessLogin}>
                                        <div className="row">
                                            <div className="col-lg-12">
                                                <div className="floating-label form-group">
                                                    <input name="username" className="floating-input form-control" type="text" autoComplete="off" placeholder="Email or Mobile" />
                                                </div>
                                            </div>
                                            <div className="col-lg-12">
                                                <div className="floating-label form-group">
                                                    <input name="password" className="floating-input form-control" type={passwordShown ? "text" : "password"} autoComplete="off" placeholder="Password" />
                                                    <span onClick={togglePasswordVisiblity} className="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" className="btn btn-primary">{userState.loader ? 'Loading...' : 'Sign In'}</button>
                                        <p className="mt-3">
                                            New Account <Link to="/register" className="text-primary">Sign Up</Link>
                                            <Link to="/reset" className="text-primary float-right">Forgot Password?</Link>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    );
}


export default Login;