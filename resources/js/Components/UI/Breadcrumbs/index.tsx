import { Link, usePage } from '@inertiajs/react';
import { RiArrowRightSLine, RiHome6Line } from '@remixicon/react';
import { Fragment } from 'react/jsx-runtime';

interface BreadcrumbItem {
    name: string;
    href: string;
    current?: boolean;
}

const Breadcrumbs = () => {
    const { url } = usePage();
    const path = url.split('?')[0];
    const segments = path.split('/').filter(Boolean);

    const breadcrumbs: BreadcrumbItem[] = segments.map((segment, index) => {
        const href = `/${segments.slice(0, index + 1).join('/')}`;

        return {
            name: segment.charAt(0).toUpperCase() + segment.slice(1),
            href: href,
            current: index === segments.length - 1,
        };
    });

    return (
        <ol className="flex min-w-0 items-center gap-2 whitespace-nowrap text-sm font-medium">
            {breadcrumbs.map((breadcrumb, index) => (
                <Fragment key={index}>
                    <li key={index}>
                        {breadcrumb.current ? (
                            <span className="rounded-md bg-red-200 px-2 py-1 text-brand">
                                {breadcrumb.name}
                            </span>
                        ) : (
                            <Link
                                href={breadcrumb.href}
                                className="text-gray-500 hover:underline"
                            >
                                {index === 0 ? (
                                    <RiHome6Line className="size-5 text-gray-500" />
                                ) : (
                                    breadcrumb.name
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
