import { cn } from '@/lib/utils';
import * as RadixUISelect from '@radix-ui/react-select';
import {
    RiArrowDownSLine,
    RiArrowUpSLine,
    RiCheckLine,
} from '@remixicon/react';

const Select = RadixUISelect.Root;

const SelectGroup = RadixUISelect.Group;

const SelectValue = RadixUISelect.Value;

const SelectTrigger = ({
    className,
    children,
    ...props
}: RadixUISelect.SelectTriggerProps) => {
    return (
        <RadixUISelect.Trigger
            className={cn(
                'flex h-[44px] w-full items-center justify-between rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-left text-sm font-medium text-gray-900 shadow-sm placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 [&>span]:line-clamp-1',
                className,
            )}
            {...props}
        >
            {children}
            <RadixUISelect.Icon asChild>
                <RiArrowDownSLine className="size-6 text-gray-600" />
            </RadixUISelect.Icon>
        </RadixUISelect.Trigger>
    );
};

const SelectScrollUpButton = ({
    className,
    ...props
}: RadixUISelect.SelectScrollUpButtonProps) => {
    return (
        <RadixUISelect.ScrollUpButton
            className={cn(
                'flex cursor-default items-center justify-center py-1',
                className,
            )}
            {...props}
        >
            <RiArrowUpSLine className="size-4" />
        </RadixUISelect.ScrollUpButton>
    );
};

const SelectScrollDownButton = ({
    className,
    ...props
}: RadixUISelect.SelectScrollDownButtonProps) => {
    return (
        <RadixUISelect.ScrollDownButton
            className={cn(
                'flex cursor-default items-center justify-center py-1',
                className,
            )}
            {...props}
        >
            <RiArrowDownSLine className="size-4" />
        </RadixUISelect.ScrollDownButton>
    );
};

const SelectContent = ({
    className,
    children,
    position = 'popper',
    ...props
}: RadixUISelect.SelectContentProps) => {
    return (
        <RadixUISelect.Portal>
            <RadixUISelect.Content
                className={cn(
                    'relative z-50 max-h-96 min-w-[8rem] overflow-hidden rounded-md border border-gray-300 bg-white text-gray-900 shadow-md data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 data-[side=bottom]:slide-in-from-top-2 data-[side=left]:slide-in-from-right-2 data-[side=right]:slide-in-from-left-2 data-[side=top]:slide-in-from-bottom-2',
                    position === 'popper' &&
                        'data-[side=bottom]:translate-y-1 data-[side=left]:-translate-x-1 data-[side=right]:translate-x-1 data-[side=top]:-translate-y-1',
                    className,
                )}
                position={position}
                {...props}
            >
                <SelectScrollUpButton />
                <RadixUISelect.Viewport
                    className={cn(
                        'p-1',
                        position === 'popper' &&
                            'h-[var(--radix-select-trigger-height)] w-full min-w-[var(--radix-select-trigger-width)]',
                    )}
                >
                    {children}
                </RadixUISelect.Viewport>
                <SelectScrollDownButton />
            </RadixUISelect.Content>
        </RadixUISelect.Portal>
    );
};

const SelectItem = ({
    className,
    children,
    ...props
}: RadixUISelect.SelectItemProps) => {
    return (
        <RadixUISelect.Item
            className={cn(
                'relative flex w-full cursor-default select-none items-center rounded-sm py-1.5 pl-8 pr-2 text-sm outline-none focus:bg-gray-100 focus:text-gray-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50',
                className,
            )}
            {...props}
        >
            <span className="absolute left-2 flex size-3.5 items-center justify-center">
                <RadixUISelect.ItemIndicator>
                    <RiCheckLine className="size-4" />
                </RadixUISelect.ItemIndicator>
            </span>

            <RadixUISelect.ItemText>{children}</RadixUISelect.ItemText>
        </RadixUISelect.Item>
    );
};

export {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectScrollDownButton,
    SelectScrollUpButton,
    SelectTrigger,
    SelectValue,
};
