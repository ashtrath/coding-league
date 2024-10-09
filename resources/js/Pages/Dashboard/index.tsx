import StatisticsCard from '@/Components/Card/StatisticsCard';
import Button from '@/Components/UI/Button';
import MainDashboardLayout from '@/Layouts/MainDashboardLayout';
import { Head } from '@inertiajs/react';
import {
    RiDashboardLine,
    RiDownloadLine,
    RiMoneyDollarCircleLine,
    RiUser3Line,
    RiVerifiedBadgeLine,
} from '@remixicon/react';

export default function Dashboard({
    totalAnggaranRealisasi,
}: {
    totalAnggaranRealisasi: number;
}) {
    return (
        <MainDashboardLayout>
            <Head title="Dashboard" />

            <section className="space-y-6">
                <div className="flex items-center gap-4">
                    <Button variant="secondary" className="flex-1">
                        Terapkan filter
                    </Button>
                    <Button variant="secondary" className="flex-1">
                        Terapkan filter
                    </Button>
                    <Button variant="secondary" className="flex-1">
                        Terapkan filter
                    </Button>
                    <Button variant="secondary" className="flex-1">
                        Terapkan filter
                    </Button>
                    <Button>Terapkan filter</Button>
                    <Button
                        variant="secondary"
                        className="gap-2 text-green-600"
                    >
                        <RiDownloadLine className="size-5" />
                        Unduh .csv
                    </Button>
                    <Button variant="secondary" className="gap-2 text-brand">
                        <RiDownloadLine className="size-5" />
                        Unduh .pdf
                    </Button>
                </div>
                <h2 className="text-[28px] font-semibold leading-[44px] tracking-tight text-gray-900">
                    Data Statistik
                </h2>
                <div className="flex items-baseline gap-6">
                    <StatisticsCard
                        icon={RiDashboardLine}
                        title="Total Proyek CSR"
                        value={1000}
                        color="orange"
                    />
                    <StatisticsCard
                        icon={RiVerifiedBadgeLine}
                        title="Proyek Terealisasi"
                        value={1000}
                        color="purple"
                    />
                    <StatisticsCard
                        icon={RiUser3Line}
                        title="Mitra Bergabung"
                        value={1000}
                        color="blue"
                    />
                    <StatisticsCard
                        icon={RiMoneyDollarCircleLine}
                        title="Total Dana Realisasi"
                        value={1000}
                        color="green"
                    />
                </div>
            </section>
        </MainDashboardLayout>
    );
}
