import React from 'react';
import { Link } from 'react-router-dom';
// import Logo from '../images/logo.png';
import Logo from '../images/nlogo.png';
import AppContext, { appState } from '../js/Context/State';
import FunctionOne from '../js/FunctionOne';

export const Sidebar = (props) => {
    // console.log(props)
    return (
        <></>
    );
}
export const Header = () => {
    let userState = React.useContext(AppContext).state
    // console.log(appState)
    // let user = appState.userDetails.all
    return (
        <></>
    );
}
export const Footer = () => {
    return (
        <></>
    );
}

export const Pageloader = () => {
    return (
        <div id="loading">
            <div id="loading-center">
            </div>
        </div>
    )
}

export const Myloader = () => {
    return (
        <div className="iq-loader-box">
            <div className="iq-loader-4"></div>
        </div>
    )
}

export const Flashmessage = () => {
    let userState = React.useContext(AppContext).state
    let subData = userState?.error
    return (
        subData?.message ?
            <div style={{
                position: 'fixed', top: '0', right: '0', backgroundColor: '#fff', zIndex: 111, padding: '12px 52px', boxShadow: '0px 0px 5px #ccc', borderBottomLeftRadius: '5px', borderTopLeftLadius: '5px', transition: 'all .2s ease-in-out'
            }}>
                <small style={{ marginBottom: '4px', fontSize: '.8rem', fontWeight: '600' }} className={subData?.type === 'success' ? 'success' : subData?.type === 'error' ? 'error' : ''}>{subData?.message}</small>
            </div> : <div></div>
    )
}

// export const Flashmessage = ({ status, msg }) => {

//     return (
//         <small style={{ marginBottom: '4px', display: 'block' }} className={status === 'success' ? 'success' : status === 'error' ? 'error' : ''}>{msg}</small>
//     )
// }




