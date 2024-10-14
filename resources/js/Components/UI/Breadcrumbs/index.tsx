import { PageProps } from '@/types';
import { Link, usePage } from '@inertiajs/react';
import { RiArrowRightSLine, RiHome6Line } from '@remixicon/react';
import { Fragment } from 'react/jsx-runtime';

export interface BreadcrumbItem {
    title: string;
    url?: string;
    current?: boolean;
}

const Breadcrumbs = () => {
    const { breadcrumbs }: PageProps = usePage().props;

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
                                className="text-gray-500 hover:underline"
                            >
                                {index === 0 ? (
                                    <RiHome6Line className="size-5 text-gray-500" />
                                ) : (
                                    breadcrumb.title
                                )}
                            </Link>
                        )}
                    </li>
                    {index < breadcrumbs.length - 1 && (
                        <RiArrowRightSLine className="size-4 text-gray-500" />
                    )}
                </Fragment>
            ))}
        </ol>
    );
};

export default Breadcrumbs;
