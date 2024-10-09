import { Link, usePage } from '@inertiajs/react';
import { RiLogoutBoxLine, RiUser3Line } from '@remixicon/react';
import Button from '../UI/Button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '../UI/Dropdown';
import ProfileImage from '../UI/ProfileImage';

const ProfileDropdown = () => {
    const user = usePage().props.auth.user;

    return (
        <DropdownMenu>
            <DropdownMenuTrigger asChild>
                <div className="flex items-center gap-1">
                    <ProfileImage
                        src={`profile_image/${user.image}`}
                        className="peer order-2"
                    />
                    <Button
                        variant="ghost"
                        className="h-fit p-2 peer-hover:bg-gray-100"
                    >
                        <div className="text-right">
                            <p className="font-medium leading-none text-gray-900">
                                {user.full_name ?? user.email}
                            </p>
                            <p className="font-normal text-gray-500">
                                {user.role}
                            </p>
                        </div>
                    </Button>
                </div>
            </DropdownMenuTrigger>
            <DropdownMenuContent className="w-52">
                <DropdownMenuLabel>
                    {user.full_name ?? user.email}
                </DropdownMenuLabel>
                <DropdownMenuSeparator />
                <DropdownMenuItem asChild>
                    <Link href={route('profile.edit')} className="w-full">
                        <RiUser3Line className="mr-2 size-4" />
                        Profile
                    </Link>
                </DropdownMenuItem>
                <DropdownMenuItem asChild>
                    <Link
                        href={route('logout')}
                        method="post"
                        as="button"
                        className="w-full text-red-600 focus:bg-red-300/40"
                    >
                        <RiLogoutBoxLine className="mr-2 size-4" />
                        Log out
                    </Link>
                </DropdownMenuItem>
            </DropdownMenuContent>
        </DropdownMenu>
    );
};

export default ProfileDropdown;
