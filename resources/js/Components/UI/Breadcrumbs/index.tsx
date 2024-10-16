import { cn } from '@/lib/utils';
import { Link, usePage } from '@inertiajs/react';
import { RiArrowRightSLine, RiHome6Line } from '@remixicon/react';
import { Fragment } from 'react/jsx-runtime';

export interface BreadcrumbItem {
    title: string;
    url?: string;
    current?: boolean;
}

interface BreadcrumbsProps {
    color?: string;
}

const Breadcrumbs = ({ color }: BreadcrumbsProps) => {
    const { breadcrumbs } = usePage().props;

    return (
        <ol className="flex min-w-0 items-center gap-2 whitespace-nowrap text-sm font-medium">
            {breadcrumbs.map((breadcrumb, index) => (
                <Fragment key={index}>
                    <li key={index}>
                        {breadcrumb.current ? (
                            <span className="rounded-md bg-red-200 px-2 py-1 text-brand">
                                {breadcrumb.title}
                            </span>
                        ) : (
                            <Link
                                href={breadcrumb.url || '#'}
                                className={cn(
                                    'text-gray-500 hover:underline',
                                    color,
                                )}
                            >
                                {index === 0 ? (
                                    <RiHome6Line
                                        className={cn(
                                            'size-5 text-gray-500',
                                            color,
                                        )}
                                    />
                                ) : (
                                    breadcrumb.title
                                )}
                            </Link>
                        )}
                    </li>
                    {index < breadcrumbs.length - 1 && (
                        <RiArrowRightSLine
                            className={cn('size-4 text-gray-500', color)}
                        />
                    )}
                </Fragment>
            ))}
        </ol>
    );
};

export default Breadcrumbs;
