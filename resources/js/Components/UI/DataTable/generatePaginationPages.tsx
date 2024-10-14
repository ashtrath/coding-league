import Button from '@/Components/UI/Button';
import { cn } from '@/lib/utils';
import { RiMoreLine } from '@remixicon/react';

export const generatePaginationLinks = (
    currentPage: number,
    totalPages: number,
    onPageChange: (page: number) => void,
) => {
    const pages: JSX.Element[] = [];
    if (totalPages <= 6) {
        for (let i = 1; i <= totalPages; i++) {
            pages.push(
                <Button
                    key={i}
                    variant="secondary"
                    onClick={() => onPageChange(i)}
                    className={cn(
                        'size-[44px] rounded-none text-gray-700',
                        currentPage === i ? 'bg-gray-100 text-gray-900' : '',
                    )}
                >
                    {i}
                </Button>,
            );
        }
    } else {
        for (let i = 1; i <= 2; i++) {
            pages.push(
                <Button
                    key={i}
                    variant="secondary"
                    onClick={() => onPageChange(i)}
                    className={cn(
                        'size-[44px] rounded-none text-gray-700',
                        currentPage === i ? 'bg-gray-100 text-gray-900' : '',
                    )}
                >
                    {i}
                </Button>,
            );
        }
        if (2 < currentPage && currentPage < totalPages - 1) {
            pages.push(
                <Button
                    key="ellipsis-before"
                    variant="secondary"
                    className="size-[44px] cursor-default rounded-none p-0 hover:bg-white"
                >
                    <RiMoreLine className="size-5" />
                    <span className="sr-only">More pages</span>
                </Button>,
            );
            pages.push(
                <Button
                    key={currentPage}
                    variant="secondary"
                    onClick={() => onPageChange(currentPage)}
                    className="size-[44px] rounded-none bg-gray-100"
                >
                    {currentPage}
                </Button>,
            );
        }
        pages.push(
            <Button
                key="ellipsis-before"
                variant="secondary"
                className="size-[44px] cursor-default rounded-none p-0 hover:bg-white"
            >
                <RiMoreLine className="size-5" />
                <span className="sr-only">More pages</span>
            </Button>,
        );
        for (let i = totalPages - 1; i <= totalPages; i++) {
            pages.push(
                <Button
                    key={i}
                    variant="secondary"
                    onClick={() => onPageChange(i)}
                    className={cn(
                        'size-[44px] rounded-none text-gray-700',
                        currentPage === i ? 'bg-gray-100 text-gray-900' : '',
                    )}
                >
                    {i}
                </Button>,
            );
        }
    }
    return pages;
};
