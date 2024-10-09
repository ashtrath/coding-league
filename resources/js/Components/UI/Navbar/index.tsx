import NotificationDropdown from '@/Components/Dropdown/NotificationDropdown';
import ProfileDropdown from '@/Components/Dropdown/ProfileDropdown';
import ApplicationLogo from '@/Components/Misc/ApplicationLogo';
import { getNavItem } from '@/lib/nav-item';
import { Link } from '@inertiajs/react';
import NavLink from './NavLink';

const Navbar = () => {
    const navItem = getNavItem();

    return (
        <nav className="fixed left-0 top-0 z-40 flex w-full items-center justify-between border-b border-b-gray-300 bg-white px-24 py-[18px] shadow-sm">
            <Link href="/">
                <ApplicationLogo className="h-10" />
            </Link>
            <ul className="flex">
                {navItem.map(({ href, label, active }, index) => (
                    <li key={index}>
                        <NavLink href={href} active={active}>
                            {label}
                        </NavLink>
                    </li>
                ))}
            </ul>
            <div className="flex items-center gap-4">
                <ProfileDropdown />
                <NotificationDropdown />
            </div>
        </nav>
    );
};

export default Navbar;
