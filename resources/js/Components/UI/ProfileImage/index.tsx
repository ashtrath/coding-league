import { cn } from '@/lib/utils';
import {
    Avatar,
    AvatarFallback,
    AvatarImage,
    type AvatarProps,
} from '@radix-ui/react-avatar';
import { RiUser3Line } from '@remixicon/react';

const ProfileImage = ({ className, ...props }: AvatarProps) => {
    return (
        <Avatar
            className={cn(
                'relative flex size-12 shrink-0 overflow-hidden rounded-full',
                className,
            )}
            {...props}
        >
            <AvatarImage
                // src="https://placehold.co/256"
                className="aspect-square size-full"
            />
            <AvatarFallback className="flex size-full items-center justify-center rounded-full bg-gray-100 text-gray-500">
                <RiUser3Line className="size-7" />
            </AvatarFallback>
        </Avatar>
    );
};

export default ProfileImage;
