import logo from '@assets/app_logo.png';
import { HTMLAttributes } from 'react';

export default function ApplicationLogo(
    props: HTMLAttributes<HTMLImageElement>,
) {
    return <img {...props} src={logo} alt="Applicaton Logo" />;
}
