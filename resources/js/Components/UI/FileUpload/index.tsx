import { cn } from '@/lib/utils';
import { FileUpload as FileUploadPrimitive } from '@ark-ui/react/file-upload';

const FileUpload = FileUploadPrimitive.Root;

const FileUploadTrigger = FileUploadPrimitive.Trigger;

const FileUploadHiddenInput = FileUploadPrimitive.HiddenInput;

const FileUploadItemPreview = FileUploadPrimitive.ItemPreview;

const FileUploadItemDeleteTrigger = FileUploadPrimitive.ItemDeleteTrigger;

const FileUploadLabel = ({
    className,
    ...props
}: FileUploadPrimitive.LabelProps) => {
    return (
        <FileUploadPrimitive.Label
            className={cn(
                'text-sm font-medium text-gray-600 peer-disabled:cursor-not-allowed peer-disabled:opacity-70',
                className,
            )}
            {...props}
        />
    );
};

const FileUploadDropzone = ({
    className,
    ...props
}: FileUploadPrimitive.DropzoneProps) => {
    return (
        <FileUploadPrimitive.Dropzone
            className={cn(
                'flex flex-col items-center justify-center gap-3 rounded-lg border border-gray-300 bg-white px-3 py-6 pt-5 shadow-sm',
                className,
            )}
            {...props}
        />
    );
};

const FileUploadItemGroup = ({
    className,
    children,
    ...props
}: Omit<FileUploadPrimitive.ItemGroupProps, 'children'> &
    FileUploadPrimitive.ContextProps) => {
    return (
        <FileUploadPrimitive.ItemGroup
            className={cn('flex flex-col gap-3', className)}
            {...props}
        >
            <FileUploadPrimitive.Context>
                {children}
            </FileUploadPrimitive.Context>
        </FileUploadPrimitive.ItemGroup>
    );
};

const FileUploadItem = ({
    className,
    ...props
}: FileUploadPrimitive.ItemProps) => {
    return (
        <FileUploadPrimitive.Item
            className={cn(
                'flex items-center gap-x-3 rounded-xl border border-gray-300 bg-white p-4 shadow-sm animate-in fade-in-5',
                className,
            )}
            {...props}
        />
    );
};

const FileUploadItemPreviewImage = ({
    className,
    ...props
}: FileUploadPrimitive.ItemPreviewImageProps) => {
    return (
        <FileUploadPrimitive.ItemPreviewImage
            className={cn('aspect-square size-16 object-scale-down', className)}
            {...props}
        />
    );
};

const FileUploadItemName = ({
    className,
    ...props
}: FileUploadPrimitive.ItemNameProps) => {
    return (
        <FileUploadPrimitive.ItemName
            className={cn('text-sm font-semibold text-gray-900', className)}
            {...props}
        />
    );
};

const FileUploadItemSizeText = ({
    className,
    ...props
}: FileUploadPrimitive.ItemSizeTextProps) => {
    return (
        <FileUploadPrimitive.ItemSizeText
            className={cn('text-sm text-gray-900', className)}
            {...props}
        />
    );
};

export {
    FileUpload,
    FileUploadDropzone,
    FileUploadHiddenInput,
    FileUploadItem,
    FileUploadItemDeleteTrigger,
    FileUploadItemGroup,
    FileUploadItemName,
    FileUploadItemPreview,
    FileUploadItemPreviewImage,
    FileUploadItemSizeText,
    FileUploadLabel,
    FileUploadTrigger,
};
