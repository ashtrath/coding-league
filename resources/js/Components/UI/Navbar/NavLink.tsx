import { cn } from '@/lib/utils';
import { Link, type InertiaLinkProps } from '@inertiajs/react';

const NavLink = ({
    active = false,
    className = '',
    children,
    ...props
}: InertiaLinkProps & { active: boolean }) => {
    return (
        <Link
            {...props}
            className={cn(
                'px-4 py-2 text-lg font-medium leading-none text-gray-900 decoration-2 underline-offset-[8px] hover:underline',
                active && 'text-brand underline',
                className,
            )}
        >
            {children}
        </Link>
    );
};

export default NavLink;
