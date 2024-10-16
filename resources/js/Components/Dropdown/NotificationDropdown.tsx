import { Link } from '@inertiajs/react';
import { PopoverClose } from '@radix-ui/react-popover';
import { RiCloseLine, RiNotification3Line } from '@remixicon/react';
import Badge from '../UI/Badge';
import Button from '../UI/Button';
import { Popover, PopoverContent, PopoverTrigger } from '../UI/Popover';

const NotificationDropdown = () => {
    return (
        <Popover>
            <PopoverTrigger asChild>
                <Button variant="ghost" size="icon" className="relative">
                    <RiNotification3Line className="size-6" />
                    <span className="absolute right-0 top-0 -mr-1 -mt-1 flex size-5">
                        <span className="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-600 opacity-75"></span>
                        <span className="relative inline-flex size-5 items-center justify-center rounded-full bg-brand text-[10px] font-semibold text-white">
                            99
                        </span>
                    </span>
                </Button>
            </PopoverTrigger>
            <PopoverContent
                sideOffset={35}
                className="mr-24 size-[500px] space-y-4 rounded-xl"
            >
                <div className="flex items-center justify-between px-5 pt-4 text-xl font-semibold">
                    Notifikasi
                    <PopoverClose asChild>
                        <Button variant="ghost" size="icon">
                            <RiCloseLine className="size-6" />
                        </Button>
                    </PopoverClose>
                </div>
                <section className="max-h-full space-y-4 overflow-y-auto px-5 pb-24">
                    <Link
                        href="/"
                        className="block space-y-1 rounded-xl border border-gray-300 bg-white p-3 transition-colors hover:bg-gray-50"
                    >
                        <Badge variant="info">Laporan Baru!</Badge>
                        <h3 className="text-sm font-semibold text-gray-900">
                            Laporan Pengadaan Perkakas Masak untuk Desa
                        </h3>
                        <p className="text-sm text-gray-500">Mitra</p>
                    </Link>
                </section>
            </PopoverContent>
        </Popover>
    );
};

export default NotificationDropdown;
