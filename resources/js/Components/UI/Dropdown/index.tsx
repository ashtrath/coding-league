import { cn } from '@/lib/utils';
import * as RadixUIDropdown from '@radix-ui/react-dropdown-menu';

const DropdownMenu = RadixUIDropdown.Root;

const DropdownMenuTrigger = RadixUIDropdown.Trigger;

const DropdownMenuGroup = RadixUIDropdown.Group;

const DropdownMenuPortal = RadixUIDropdown.Portal;

const DropdownMenuContent = ({
    className,
    sideOffset = 4,
    ...props
}: RadixUIDropdown.DropdownMenuContentProps) => {
    return (
        <DropdownMenuPortal>
            <RadixUIDropdown.Content
                sideOffset={sideOffset}
                className={cn(
                    'data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 data-[side=bottom]:slide-in-from-top-2 data-[side=left]:slide-in-from-right-2 data-[side=right]:slide-in-from-left-2 data-[side=top]:slide-in-from-bottom-2 z-50 min-w-[8rem] overflow-hidden rounded-md border bg-white p-1 text-gray-900 shadow-md',
                    className,
                )}
                {...props}
            />
        </DropdownMenuPortal>
    );
};

const DropdownMenuItem = ({
    className,
    inset,
    ...props
}: RadixUIDropdown.DropdownMenuItemProps & { inset?: boolean }) => {
    return (
        <RadixUIDropdown.Item
            className={cn(
                'relative flex cursor-default select-none items-center rounded-sm px-2 py-1.5 text-sm text-gray-900 underline-offset-2 outline-none transition-colors focus:bg-gray-100 focus:underline data-[disabled]:pointer-events-none data-[disabled]:opacity-50',
                inset && 'pl-8',
                className,
            )}
            {...props}
        />
    );
};

const DropdownMenuLabel = ({
    className,
    inset,
    ...props
}: RadixUIDropdown.DropdownMenuLabelProps & { inset?: boolean }) => {
    return (
        <RadixUIDropdown.Label
            className={cn(
                'px-2 py-1.5 text-sm font-semibold',
                inset && 'pl-8',
                className,
            )}
            {...props}
        />
    );
};

const DropdownMenuSeparator = ({
    className,
    ...props
}: RadixUIDropdown.DropdownMenuSeparatorProps) => {
    return (
        <RadixUIDropdown.Separator
            className={cn('-mx-1 my-1 h-px bg-gray-100', className)}
            {...props}
        />
    );
};

export {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuPortal,
    DropdownMenuSeparator,
    DropdownMenuTrigger
};

