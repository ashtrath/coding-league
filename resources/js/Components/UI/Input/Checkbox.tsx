import { cn } from '@/lib/utils';
import * as RadixCheckbox from '@radix-ui/react-checkbox';
import { RiCheckLine } from '@remixicon/react';
import { type ComponentPropsWithoutRef } from 'react';

const Checkbox = ({
    className,
    ...props
}: ComponentPropsWithoutRef<typeof RadixCheckbox.Root>) => {
    return (
        <RadixCheckbox.Root
            className={cn(
                'peer size-5 shrink-0 rounded-sm border border-gray-300 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-brand data-[state=checked]:text-white',
                className,
            )}
            {...props}
        >
            <RadixCheckbox.Indicator className="flex items-center justify-center text-current">
                <RiCheckLine className="size-5" />
            </RadixCheckbox.Indicator>
        </RadixCheckbox.Root>
    );
};

export default Checkbox;
